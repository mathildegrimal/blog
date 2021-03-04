<?php

class PostsListView extends Layout 
{
    public function __construct ($title, $data, $error,$message) {
        parent::__construct ($title, $data, $error,$message);
    }

    public function htmlBody()  : string {
        $html = <<<EOD
        <section id="main">
        <h1 id="title">$this->title</h1>
        <p class="error">
            $this->error
        </p>
        <p class="success">
            $this->message
        </p>
        <article>
        <p> Display by
            <a href='?route=1&option=date'>Date</a>
            <a href='?route=1&option=title'>Title</a>
        <p>
    EOD;
        if ($this->data != null) {
            foreach ($this->data as $post) {
                $id= $post->getId();
                $title = $post->getTitle();
                $author = $post->getAuthor();
                $date = $post->getCreationDate();
                $routeExpanded = "?route=2&id=".$id;
                $html .= <<<EOD
            <div class='articleContainer'>
                <div class='detailContainer'>
                    <div class='articleTitle'>$title- by $author </div>
                    <div>Date de publication : $date </div>
                    <a class='link' href='$routeExpanded'><button class='btn btn-secondary'>Voir</button></a>
                </div>            
            </div>
    EOD;
            }
        }
        
        
        $html .= <<<EOD
            </article>
        </section>
    EOD;
        
        return $html;

    }

}