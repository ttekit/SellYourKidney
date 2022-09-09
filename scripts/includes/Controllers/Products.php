<?php

namespace App;

class Products extends Controller
{
    public function index(){
        $this->format_options();
        $this->returnNavigationPanel();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainProducts".EXT, $this->data);
    }

}