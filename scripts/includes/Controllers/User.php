<?php

namespace App;

use http\Header;
use Models\tags;
use Models\userAcc;

class User extends Controller
{
    public function index()
    {
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_userData();
        if ($this->CheckOnLogin()) {
            $this->UserCabinetView();
        } else {
            $this->LoginUserView();
        }

    }

    public function LoginUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["email"]) && isset($_POST["password"])) {
                $this->data["error"] = null;
                $email = htmlspecialchars(trim($_POST["email"]));

                if (!Validator::email($email)) {
                    $this->data["error"]["email"] = "email wrote incorrect";
                }

                if ($this->data["error"] == null) {
                    $userDB = new userAcc();
                    $userAcc = $userDB->getByEmail($email);
                    if ($userAcc == null) {
                        $this->data["error"]["user"] = "Incorrect data";
                        $this->LoginUserView();
                    } else {
                        $this->data["success"] = "Thank you very much! Your message is very important to us!";
                        $_SESSION["reg"]["email"] = $email;
                        $_SESSION["reg"]["userId"] = $userAcc["id"];
                        $_SESSION["reg"]["user_Ip"] = $_SERVER["REMOTE_ADDR"];
                        $_SESSION["reg"]["role"] = "user";
                        header("Location: /user/");
                    }
                } else {
                    $this->LoginUserView();
                }
            }
        } else {
            header('Location: /user');
        }
    }

    public function RegUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["passwordConfirm"])) {
                $this->data["error"] = null;
                $login = htmlspecialchars(trim($_POST["login"]));
                $email = htmlspecialchars(trim($_POST["email"]));
                $password = htmlspecialchars(trim($_POST["password"]));
                $passwordConfirm = htmlspecialchars(trim($_POST["passwordConfirm"]));
                $userDB = new userAcc();
                echo $password;
                if (!Validator::email($email)) {
                    $this->data["error"]["email"] = "email is incorrect";
                    if ($userDB->getByEmail($email) != null) {
                        $this->data["error"]["accReg"] = "This email has been registered";
                    }
                }
                if (strlen($password) < 8 || strlen($password) > 24) {
                    $this->data["error"]["password"] = "Password must to be from 8 to 24 symbols";
                }
                if ($passwordConfirm != $password) {
                    $this->data["error"]["passwordConfirm"] = "Passwords do not match";
                }
                if ($this->data["error"] == null) {

                    $userDB = new userAcc();
                    $userDB->AddNewUser([
                        "login" => $login,
                        "email" => $email,
                        "password" => hash('sha256', $password)
                    ]);
                    $userAcc = $userDB->getByEmail($email);
                    $this->data["success"] = "Account has been successfully logged!";
                    $_SESSION["reg"]["email"] = $email;
                    $_SESSION["reg"]["userId"] = $userAcc["id"];
                    $_SESSION["reg"]["user_Ip"] = $_SERVER["REMOTE_ADDR"];
                    $_SESSION["reg"]["role"] = "user";
                } else {
                    $this->Register();
                }
            }
        }
    }

    public function LoginUserView()
    {
        if (!$this->CheckOnLogin()) {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainLogin" . EXT, $this->data);
        } else {
            $this->UserCabinetView();
        }
    }

    public function Edit()
    {
        if (!$this->CheckOnLogin()) {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainLogin" . EXT, $this->data);
        } else {
            $this->EditCabinetView();
        }
    }

    private function EditCabinetView()
    {
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_userData();
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "editUserCabinet" . EXT, $this->data);
    }

    public function saveEditChages()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["email"])) {
                varDump($_POST);
            }
        } else {
            header('Location: /user');
        }
    }

    public function UserCabinetView()
    {
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_userData();
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainUserCabinet" . EXT, $this->data);
    }

    public function Register()
    {
        if (!$this->CheckOnLogin()) {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainRegister" . EXT, $this->data);
        } else {
            $this->UserCabinetView();
        }

    }

    private function CheckOnLogin()
    {
        if (isset($_SESSION["reg"])) {
            if ($_SESSION["reg"]["role"] == "user") {
                return true;
            }
        }
        return false;
    }

    private function format_userData()
    {
        if ($this->CheckOnLogin()) {
            $userDataBase = new userAcc();
            $this->data["userData"] = $userDataBase->getByEmail($_SESSION["reg"]["email"]);
        }
    }
}