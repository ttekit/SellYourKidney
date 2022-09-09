<?php

namespace App;

use Models\comments;
use Models\post;

class Blog extends Controller
{
    public function index(){
        if(isset($_GET["pageCount"])){
            $this->data["pagination"]["currentPage"] = $_GET["pageCount"];
        }
        else{
            $this->data["pagination"]["currentPage"] = 0;
        }

        if(isset($_GET["count"])){
            $this->data["pagination"]["postsCount"] = $_GET["count"];
        }
        else{
            $this->data["pagination"]["postsCount"] = 3;
        }
        if(isset($_GET["filter"])){
            $this->data["blog"]["filter"] = $_GET["filter"];
        }

        $this->data["href"] = $_SERVER["REQUEST_URI"];
        $this->format_options();
        $this->returnNavigationPanel();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainBlog".EXT, $this->data);
    }

    public function post(){
            if(isset($_GET["slug"])){
                $this->data["error"] = null;
                $slug = $_GET["slug"];
                $postM = new post();
                $onePost = $postM->getBySlug($slug);
                if(!is_null($onePost)) {
                    $this->data["pageData"] = $onePost;
                    $this->format_options();
                    $this->returnNavigationPanel();
                    View::render(VIEWS_PATH . "admtemplate" . EXT, PAGES_PATH . "mainBlogPost" . EXT, $this->data);
                }
            }
    }

    public function __construct()
    {
    }
}