<?php

namespace App;

use Models\categories;
use Models\comments;
use Models\post;
use Models\tags;
use Models\userAcc;

class Ajax extends Controller
{
    public function index()
    {
        return null;
    }

    public function getComments()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"])) {
                $id = $_POST["postId"];
                $commentsM = new comments();

                echo json_encode($commentsM->getById($id), JSON_UNESCAPED_UNICODE);
            }

        } else {
            echo "xD nice try";
        }
    }

    public function getSubComments()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["parentId"])) {
                $parentId = $_POST["parentId"];
                $commentsM = new comments();

                echo json_encode($commentsM->getSubCommentsBParentId($parentId), JSON_UNESCAPED_UNICODE);
            }

        } else {
            echo "ok";
        }
    }

    public function saveComment()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"]) && isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["message"])) {
                if (isset($_POST["messageId"])) {
                    $messageId = $_POST["messageId"];
                } else {
                    $messageId = "NULL";
                }
                $postId = $_POST["postId"];
                $login = $_POST["login"];
                $email = $_POST["email"];
                $message = $_POST["message"];
                $commentsM = new comments();
                echo $commentsM->insertNewComment($postId, $login, $email, $message, $messageId);
            }
        }
    }

    public function deleteOnePost()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"])) {
                $postM = new post();
                $postM->removeOnePost($_POST["postId"]);
                echo "POST_REMOVED";
            }
        }
    }

    public function updatePostStatus()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"]) && isset($_POST["newStatus"])) {
                $postData = $_POST;
                $postM = new post();
                $result = $postM->updateRow($postData["postId"], [
                    "state" => $postData["newStatus"]
                ]);
                echo $result;
            }
        }
    }

    public function updateSocLinkData()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["name"]) && isset($_POST["link"])) {
                $userDataArr = new UserAcc();
                $accData = $userDataArr->executeQuery("SELECT useracc.socLinks FROM useracc WHERE id=" . $_SESSION["reg"]["userId"]);
                $accData[0]["socLinks"] = json_decode($accData[0]["socLinks"]);
                array_push($accData[0]["socLinks"], $_POST);
                $userDataArr->updateUserData($_SESSION["reg"]["userId"], ["socLinks" => json_encode($accData[0]["socLinks"])]);
                echo(json_encode($accData[0]["socLinks"]));
            }
        }
    }

    public function getCategory()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["postId"])) {
                $postData = $_GET;
                $categories = new categories();
                $result = $categories->getCategoryByPostId($postData["postId"]);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function getTags()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["postId"])) {
                $postData = $_GET;
                $tagsM = new tags();

                $result = $tagsM->getByPostId($postData["postId"]);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
