<?php

class Comment {

    private $nickName;
    private $contents;
    private $creationDate;
    private $postId;

    public function __construct(string $nickName, string $contents, string $creationDate, int $postId)
    {
        try {
            $this->nickName = htmlspecialchars($nickName);
            $this->contents = htmlspecialchars($contents);
            $this->creationDate = htmlspecialchars($creationDate);
            $this->postId = htmlspecialchars($postId);
        } catch (BlogException $e){
            echo $e->getErrorMessage(2,"data for comments are not valid");
        }
    }
   
    /**
     * Get the value of nickName
     */ 
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Get the value of contents
     */ 
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Get the value of creationDate
     */ 
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Get the value of postId
     */ 
    public function getPostId()
    {
        return $this->postId;
    }
}
