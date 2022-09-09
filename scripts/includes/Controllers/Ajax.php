<?php

namespace App;

use Models\comments;

class Ajax extends Controller
{
    public function index(){
        return null;
    }
    public function getComments(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["postId"])){
                $id = $_POST["postId"];
                $commentsM = new comments();

                echo json_encode($commentsM->getById($id), JSON_UNESCAPED_UNICODE);
            }

        }
        else{
            echo "xD nice try";
        }
    }
    public function getSubComments(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["parentId"])){
                $parentId = $_POST["parentId"];
                $commentsM = new comments();

                echo json_encode($commentsM->getSubCommentsBParentId($parentId), JSON_UNESCAPED_UNICODE);
            }

        }
        else{
            echo "ok";
        }
    }
    public function saveComment(){
        if($_SERVER["REQUEST_METHOD"]== "POST"){
            if(isset($_POST["postId"]) && isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["message"])){
                if(isset($_POST["messageId"])){
                    $messageId=$_POST["messageId"];
                }
                else{
                    $messageId = "NULL";
                }
                $postId = $_POST["postId"];
                $login = $_POST["login"];
                $email = $_POST["email"];
                $message = $_POST["message"];
                $commentsM = new comments();
                echo $commentsM->insertNewComment($postId,$login,$email,$message, $messageId);
            }
        }
    }
    public function saveOptions(){
        if(UserAuthorisation::isUserAuthorized()){
            if(isset($_POST["name"]) && isset($_POST["value"])){
                $name = $_POST["name"];
                $value = $_POST["value"];
                $optionM = new options();
                $optionM->add($name, $value);
                echo "SADASD";
            }
        }
    }}