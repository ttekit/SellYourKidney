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
}