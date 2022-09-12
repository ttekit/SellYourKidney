<?php

namespace Models;

class categories extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('categories');

    }

    public function getByCategory($category)
    {
        $result = $this->getManyRows(["category" => $category]);
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }


    public function AddCategory($category)
    {
        return parent::addRow([
            'category' => $category,
        ]);
    }
    public function getAllNotEmptyCategories(){
        return $this->executeQuery("SELECT categories.category FROM categories WHERE categories.countPosts > 0");
    }
    public function getAllCategories(){
        return $this->executeQuery("SELECT * FROM categories");
    }
}