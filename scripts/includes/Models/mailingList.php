<?php

namespace Models;

class mailingList extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("EmailingList");
    }

    public function addEmail($email)
    {
        return $this->addRow(["email"=>$email]);
    }
}