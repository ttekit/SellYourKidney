<?php

namespace App;

use Models\options;
use Models\post;

class admin extends Controller
{
    public function index()
    {
        $this->data["error"] = null;
        $this->data["success"] = null;
        $this->data["message"] = null;
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "mainAdminPanel" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function Login()
    {
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, ADM_ALL_PAGES_PATH . "mainAdminLogin" . EXT, $this->data);
    }

    public function blogManage()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "blogManage" . EXT, $this->data);
        }
    }

    public function AddProd()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "mainAdminProductAdd" . EXT, $this->data);
        }
    }

    public function onePostEdit()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            if (isset($_GET["postId"])) {
                $this->data["postId"] = $_GET["postId"];
                View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "OnePostEdit" . EXT, $this->data);
            }
        }
    }

    public function productManage()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            $productM = new \Models\products();
            $this->data["allProd"] = $productM->getAllProducts();
            unset($productM);

            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "productManage" . EXT, $this->data);
        }
    }

    public function OneProductEdit()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            if (isset($_GET["prodId"])) {
                $this->data["prodId"] = $_GET["prodId"];
                $prodM = new \Models\products();
                $this->data["prodData"] = $prodM->getById($this->data["prodId"]);
                View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "OneProdEdit" . EXT, $this->data);
            }
        }
    }

    public
    function updatePost()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['title']) && isset($_POST['slogan']) && isset($_POST['content']) && isset($_POST['files'])) {
                    $postM = new post();
                    $postM->updateRow($_POST["id"], [
                        "title" => $_POST['title'],
                        "slogan" => $_POST['slogan'],
                        "content" => $_POST['content'],
                    ]);
                    if ($_POST["files"] != "") {
                        $postM->updateRow($_POST["id"], [
                            "imgSrc" => $_POST["files"]
                        ]);
                    }
                }
            }
        }
        header("Location: /admin/blogManage");
    }

    public
    function addNewOption()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["name"]) && isset($_POST["value"]) && isset($_POST["group"])) {
                    $newData = $_POST;
                    $optM = new options();
                    $optM->add($newData["name"], $newData["value"], $newData["group"]);
                    header("Location: /admin/tables");
                }
            }
        }
    }


    public
    function updateRow()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['name']) && isset($_POST['value']) && isset($_POST['group']) && isset($_POST['id'])) {
                    $newData = $_POST;
                    $optM = new options();
                    $row = $optM->executeQuery("SELECT * FROM options WHERE id=" . $newData['id']);
                    $row = $row[0];
                    if ($newData["group"] == "") {
                        $newData["group"] = "NULL";
                    }
                    if ($row->name != $newData["name"] || $row->value != $newData["value"] || $row->group != $newData["group"]) {
                        $optM->updateRow($row->id, [
                            "name" => $newData["name"],
                            "value" => $newData["value"],
                            "group" => $newData["group"]
                        ]);

                    }
                }
            }
            header("Location: /admin/tables");
        }
    }


    public
    function updateProd()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST["id"]) &&isset($_POST['name']) && isset($_POST['price']) && isset($_POST['content']) && isset($_POST['files'])) {
                    $postM = new \Models\products();
                    $postM->updateRow($_POST["id"], [
                        "name" => $_POST['name'],
                        "price" => $_POST['price'],
                        "content" => $_POST['content'],
                    ]);
                    if ($_POST["files"] != "") {
                        $postM->updateRow($_POST["id"], [
                            "img_src" => $_POST["files"]
                        ]);
                    }
                }
            }
        }
        header("Location: /admin/productManage");
    }

    public
    function addNewProd()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ( isset($_POST['name']) && isset($_POST['price']) && isset($_POST['content']) && isset($_POST['files'])) {
                    $postM = new \Models\products();
                    $postM->AddProduct($_POST['name'], $_POST["files"], "/", $_POST["price"], $_POST["content"]);
                    if ($_POST["files"] != "") {
                        $postM->updateRow($_POST["id"], [
                            "img_src" => $_POST["files"]
                        ]);
                    }
                }
            }
        }
        header("Location: /admin/productManage");
    }

    public
    function check()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["email"]) && isset($_POST["password"])) {
                $email = htmlspecialchars(trim($_POST["email"]));
                $password = hash("sha256", htmlspecialchars(trim($_POST["password"])));
                if (UserAutrntification::isUserValid($email, $password) != null) {
                    UserAuthorisation::AuthorizedExecute();
                    header("Location: /admin/index");
                } else {
                    $this->Login();
                }
                //UserAuthorisation::isUserAuthorized();
            }
        }
    }

    public
    function buttons()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "buttons" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function cards()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "cards" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function colors()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "colors" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function borders()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "borders" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function animations()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "animations" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function other()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "other" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function forgotPassword()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "forgotPassword" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function charts()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "charts" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function tables()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "tables" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public
    function logOut()
    {
        session_destroy();
        header:
        "Location: /main";
    }
}