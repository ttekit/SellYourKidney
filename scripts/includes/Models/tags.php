<?php

namespace Models;

class tags extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct('tags');

    }
    public function getAllNotEmptyTegs(){
        return $this->executeQuery("SELECT tags.tag FROM tags WHERE tags.countPosts > 0");
    }
    public function getIdByTag($tag)
    {
        $result = $this->getId(["post_id" => $tag]);
        if (count($result) > 0) {
            return $result[0];
        }
        return null;
    }


    public function AddTag($tag)
    {

        return parent::addRow([
            'tag' => $tag
        ]);
    }
}