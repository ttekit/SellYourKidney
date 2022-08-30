<?php

namespace App;

class admin extends Controller
{
    public function index(){
        $this->data["error"] = null;
        $this->data["success"] = null;
        $this->data["message"] = null;
        $this->format_options();
        $this->returnNavigationPanel();
        $this->Login();
    }
    public function Login(){
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainAdminLogin".EXT, $this->data);
    }
    public function adminLogin(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["email"]) && isset($_POST["password"])){
                $email = htmlspecialchars(trim($_POST["email"]));
                $password = htmlspecialchars(trim($_POST["password"]));

                if ($email != ADMAIL) {
                    $this->data["error"] = "incorrect data";
                }
                if($password != ADPASS){
                    $this->data["error"] = "incorrect data";
                }


            }
        }

        if($this->data["error"] == null){
            View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainAdminPanel".EXT, $this->data);

        }
        else{
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "template" . EXT, PAGES_PATH . "mainIndex" . EXT, $this->data);
        }

    }
}