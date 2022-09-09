<?php

namespace App;

class admin extends Controller
{
    public function index(){
        $this->data["error"] = null;
        $this->data["success"] = null;
        $this->data["message"] = null;
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."mainAdminPanel".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function Login(){
        View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."mainAdminLogin".EXT, $this->data);
    }
    public function check(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["email"]) && isset($_POST["password"])){
                $email = htmlspecialchars(trim($_POST["email"]));
                $password = hash("sha256", htmlspecialchars(trim($_POST["password"])));
                if(UserAutrntification::isUserValid($email, $password) != null){
                    UserAuthorisation::AuthorizedExecute();
                    header("Location: /admin/index");
                }else{
                    $this->Login();
                }
                //UserAuthorisation::isUserAuthorized();
            }
        }
    }
    public function buttons(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."buttons".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function cards(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."cards".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function colors(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."colors".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function borders(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."borders".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function animations(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."animations".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function other(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."other".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function forgotPassword(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."forgotPassword".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function charts(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."charts".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function tables(){
        if(UserAuthorisation::isUserAuthorized()){
            View::render(VIEWS_PATH."admtemplate".EXT, ADM_ALL_PAGES_PATH."tables".EXT, $this->data);
        }
        else{
            $this->Login();
        }
    }
    public function logOut(){
        session_destroy();
        header: "Location: /main";
    }
}