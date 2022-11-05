<?php

namespace Models;

class userSocLincs extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("admin");
    }

    public function getSocLinksOfUser($id)
    {
        $result = $this->executeQuery("SELECT * FROM usersoclinks WHERE UserId = $id");
        varDump($result);
        if (isset($result)) {
            return $result;
        }
        return null;
    }
    public function addSocLinkToUser($id, $socLink, $socName, $userId)
    {
        $result = $this->executeQuery("INSERT INTO usersoclinks(SocLink, SocName, UserId) VALUES($socLink,$socName ,$userId )");
        return $result;
    }
}