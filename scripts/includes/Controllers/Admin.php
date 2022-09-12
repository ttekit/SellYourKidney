<?php

namespace App;

use Models\options;

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
        View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "mainAdminLogin" . EXT, $this->data);
    }

    public function blogManage(){
        View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "blogManage" . EXT, $this->data);
    }

    public function addNewOption(){
        if (UserAuthorisation::isUserAuthorized()) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST["name"]) && isset($_POST["value"]) && isset($_POST["group"])){
                    varDump($_POST);
                    $newData = $_POST;
                    $optM = new options();
                    $optM->add($newData["name"], $newData["value"], $newData["group"]);
                    header("Location: /admin/tables");
                }
            }
        }
    }
    public function updateRow(){
        if (UserAuthorisation::isUserAuthorized()) {
            echo $_SERVER['REQUEST_METHOD'];
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

    public function check()
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

    public function buttons()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "buttons" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function cards()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "cards" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function colors()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "colors" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function borders()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "borders" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function animations()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "animations" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function other()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "other" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function forgotPassword()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "forgotPassword" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function charts()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "charts" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function tables()
    {
        if (UserAuthorisation::isUserAuthorized()) {
            View::render(VIEWS_PATH . "admtemplate" . EXT, ADM_ALL_PAGES_PATH . "tables" . EXT, $this->data);
        } else {
            $this->Login();
        }
    }

    public function logOut()
    {
        session_destroy();
        header:
        "Location: /main";
    }
}