<?php

namespace Models;
class comments extends \App\DBEngine
{
    public function __construct()
    {
        parent::__construct("blogposts");
    }

    public function getAllComentsUnderPost($postId)
    {
        return $this->getManyRows([
            "post_id"=>$postId
        ]);
    }

    public function makeNewComment($login, $email, $comment, $dateOfComment, $client_ip)
    {
        return $this->addRow([
            "login"=>$login,
            "email"=>$email,
            "comment"=>$comment,
            "dateOfComment"=>$dateOfComment,
            "verified"=>false,
            "client_ip"=>$client_ip
        ]);
    }

}
