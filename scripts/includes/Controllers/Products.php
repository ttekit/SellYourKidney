<?php

namespace App;

class Products extends Controller
{
    public function index(){
        $this->format_options();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainProducts".EXT, $this->data);
    }

}