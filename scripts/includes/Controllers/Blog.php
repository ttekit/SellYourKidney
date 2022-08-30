<?php

namespace App;

use Models\post;

class Blog extends Controller
{
    public function index(){
        $this->format_options();
        $this->returnNavigationPanel();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainBlog".EXT, $this->data);
    }

    public function post(){
            if(isset($_GET["slug"])){
                $slug = $_GET["slug"];
                $postM = new post();
                $onePost = $postM->getBySlug($slug);
                varDump($onePost);
                if(!is_null($onePost)) {
                    $this->data["pageData"] = $onePost;
                    $this->format_options();
                    $this->returnNavigationPanel();
                    View::render(VIEWS_PATH . "template" . EXT, PAGES_PATH . "mainBlogPost" . EXT, $this->data);
                }
            }
        }
    public function __construct()
    {
    }
}