<?php

abstract class Layout 
{       // template de base, affichage
    protected $title = "";  // titre page
    protected $error = "";  // erreur éventuelle
    protected $data = null; // paquet de data
    //protected $message = ""; // message de bon fonctionnement éventuel
    protected $htmls = []; // tableau de ligne HTML généré, vérifier le code (view source) 

    public function __construct ($title, $data, $error,$message) {
        $this->title = $title;
        
        $this->data = $data;
        $this->error = $error;
        $this->message = $message;

        $this->htmls [] = $this->htmlHeader();
        if($this->data != null){
            $this->htmls [] = $this->htmlBody();
        } else{
            $this->htmls [] = $this->htmlError();
        }
       
        $this->htmls [] = $this->htmlFooter();
    }

    public function render() : void {
        echo implode (PHP_EOL, $this->htmls);   
    }
//------------------------------------------- must be instantiated by children!!
    abstract protected function htmlBody()  : string;

    private function htmlError(){

        $html = <<<EOD
        <section id="main">
        <h1 id="title">$this->title </h1>
        <p class="error">
        $this->error
        </p>
        </section>          
        EOD;

        return $html;
    }

//------------------------------------------- private below
    private function htmlHeader () : string {
        $html = <<<EOD
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="utf-8">
            <title>Mon Blog</title>
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans">
            <link rel="stylesheet" href="view/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        
        </head>
        <body>
            <header>        
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Mon Blog</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?route=1">Accueil</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="?route=3">Ajouter un article</a>
                            </li>                              
                        </ul>
                        </div>
                    </div>
                </nav>
            </header>

EOD;
        return $html;
    }

    private function htmlFooter () : string {
        $html = <<<EOD
        <footer class="text-light bg-secondary text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Footer Content</h5>

                    <p>
                    Un blog de tout et n'importe quoi
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 ">
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled mb-0 ">
                        <li>
                            <a href="?route=1" class="text-light">Accueil</a>
                        </li>
                        <li>
                            <a href="?route=3" class="text-light">Ajouter un article</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center p-3" style="background-color: black">
        © 2020 Copyright:
            <a class="text-light" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>
</html>
EOD;
        return $html;
    }


}