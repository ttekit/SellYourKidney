<?php

namespace App;

class Products extends Controller
{
    public function index(){
        $this->format_options();
        $this->returnNavigationPanel();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainProducts".EXT, $this->data);
    }
    public function product(){
        if(isset($_GET["device"])){
            $this->data["error"] = null;
            $devId = $_GET["device"];
            $prodM = new \Models\products();
            $onePost = $prodM->getById($devId);
            if(!is_null($onePost)) {
                $this->data["pageData"] = $onePost;
                $this->format_options();
                $this->returnNavigationPanel();
                View::render(VIEWS_PATH . "template" . EXT, PAGES_PATH . "mainProductPage" . EXT, $this->data);
            }
        }
        $this->format_options();
        $this->returnNavigationPanel();

    }
}