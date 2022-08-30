<?php

namespace App;
use Models\contactInfo;

class Contact extends Controller
{
    public function index(){
        $this->data["error"] = null;
        $this->data["success"] = null;
        $this->data["message"] = null;

        $this->format_options();
        $this->returnNavigationPanel();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainContact".EXT, $this->data);
    }
    public function getClientMessage(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["name"]) && isset($_POST["email"])&& isset($_POST["subject"])&& isset($_POST["message"])){
                $name = htmlspecialchars(trim($_POST["name"]));
                $email = htmlspecialchars(trim($_POST["email"]));
                $subject = htmlspecialchars(trim($_POST["subject"]));
                $message = htmlspecialchars(trim($_POST["message"]));
                if(!Validator::length($name, 2, 50)){
                    $this->data["error"]["name"] = "Name must to be from 2 to 50 symbols";
                }
                if (!Validator::email($email)) {
                    $this->data["error"]["email"] = "email is incorrect";
                }
                if(!Validator::length($subject, 5, 50)){
                    $this->data["error"]["subject"] = "Subject must to be from 5 to 50 symbols";
                }
                if(!Validator::length($message, 25, 1200)){
                    $this->data["error"]["message"] = "Message must to be from 25 to 1200 symbols";
                }

            }
        }
        else{
            $this->data["error"] = "Cant send message.";
        }
        if($this->data["error"] == null){
            $cim = new contactInfo();
            $cim->SaveMessage($name, $email, $subject." : ".$message);
            $this->data["success"] = "Thank you very much! Your message is very important to us!";
        }
        $this->format_options();
        $this->returnNavigationPanel();
        View::render(VIEWS_PATH . "template" . EXT, PAGES_PATH . "mainError" . EXT, $this->data);

    }
    public function __construct()
    {
    }
}