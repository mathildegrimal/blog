<?php
class PostView extends Layout 
{

    public function __construct ($title, $data, $error, $message) {
        parent::__construct ($title, $data, $error, $message);
    }

    public function htmlBody()  : string {
        
        $title = $this->data->getTitle();
        $id=$this->data->getId();
        $content = $this->data->getContents();
        $img = $this->data->getImg();
        $author = $this->data->getAuthor();
        $date = $this->data->getCreationDate();
        $routeExpanded = "?route=4&id=".$this->data->getId();        
        $html = <<<EOD
        <section id="main">
        <h1 id="title">$this->title </h1>
            <p class="error">
            $this->error
            </p>
        <article>
        <div class='articleContainer'>
            <div class='detailContainer'>            
                <img class='articleImage' src='$img'/>            
                <div class='articleTitle'>$title- by $author </div>
                <div class='articleDate'>Date de publication : $date</div>
                <div class='articleContent'>$content</div>                
                <div class='articleComments'>                
                    <div class='commentTitle'>Commentaires
                        <form action="index.php?route=2&id=$id" method="post">            
                            <div class="col-md-4 mb-3">
                                <label for="validationServer01">First name</label>
                                <input name="nickName" type="text" class="form-control" is-valid"" id="validationServer01" placeholder="First name" value="" required>
                                <div class="valid-feedback">
                                Looks good!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="validationTextarea">Textarea</label>
                                <textarea name="comment" class="form-control" id="validationTextarea" placeholder="Required example textarea" required></textarea>
                                <div class="invalid-feedback">
                                Please enter a message in the textarea.
                                </div>
                            </div>
                            <button name="submit" type="submit" class="btn btn-secondary">Poster le commentaire</button>
                        </form>
                    </div>
    EOD;
        $comments = $this->data->getComments();
        if (count($comments)>0) {
            foreach ($comments as $comment) {
                $nom = $comment->getNickName();
                $date = $comment->getCreationDate();
                $content=$comment->getContents();
                $html.= <<<EOD
            <div class="comment">
                <div class="nicknameComment">$nom</div>
                <div>Date de publication : $date</div>
                <div class="content">$content</div>       
            </div>
            EOD;
            }
        } else {
            $html .= "<div>Aucun commentaire</div>";
        }

        $html .= <<<EOD
                    </div>        
                </div> 
            </div>                         
            </div>
        </article>
    </section>
    EOD;
    
    return $html;
    }

}