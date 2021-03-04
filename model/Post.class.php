<?php

class Post {

    private $id =0;
    private $title ="";
    private $contents="";
    private $creationDate="";
    private $author="";
    private $img="";
    private $comments = [];

    public function __construct(int $id, string $title, string $contents, string $creationDate, string $author, string $img, array $comments)
    {
        $this->id = htmlspecialchars($id);
        $this->title = htmlspecialchars($title);
        $this->contents = htmlspecialchars($contents);
        $this->creationDate = htmlspecialchars($creationDate);
        $this->author = htmlspecialchars($author);
        $this->img = htmlspecialchars($img);    
        $this->comments =$comments;
         
    } 
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
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
     * Get the value of author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }

    public function getComments()
    {
        return $this->comments;
    }
}