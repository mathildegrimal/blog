<?php
class AddPostView extends Layout 
{
    

    public function __construct ($title, $data,$error,$message) {
        parent::__construct ($title, "none", $error, $message);
    }

    public function htmlBody()  : string {
        $title = $this->title;
        $html = <<<EOD
            <section id="main">
            <h1 id="title">$title</h1>
            <p class="error">$this->error</p>
            <p class="success">$this->message</p>
                <article>
                    <div class='formContainer'>
                        <form action="index.php?route=1" method="post">            
                            <div class="col-md-4 mb-3">
                                <label for="validationServer01">Your Name</label>
                                <input name="author" type="text" class="form-control" id="validationServer01" placeholder="First name" value="" required>
                                <div class="valid-feedback">
                                Looks good!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationServer01">Title</label>
                                <input name="title" type="text" class="form-control" id="validationServer01" placeholder="Title for your article" value="" required>
                                <div class="valid-feedback">
                                Looks good!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="validationTextarea">Content</label>
                                <textarea rows="10" name="content" class="form-control" id="validationTextarea" placeholder="Content of your article" required></textarea>
                                <div class="invalid-feedback">
                                Please enter a message in the textarea.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationServer01">URL for the image</label>
                                <input name="image" type="text" class="form-control" id="validationServer01" placeholder="ex : https://www.google.com/image.png" value="" required>
                                <div class="valid-feedback">
                                Looks good!
                                </div>
                            </div>
                            <button name="submit" type="submit" class="btn btn-secondary">Poster l'article</button>
                        </form>
                    </div>
                </article>
            </section>
        EOD;
        
        return $html;
    }

}