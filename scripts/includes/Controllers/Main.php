<?php

namespace App;
class Main extends Controller
{
    public function index(){
        $this->format_options();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainIndex".EXT, $this->data);
    }

}