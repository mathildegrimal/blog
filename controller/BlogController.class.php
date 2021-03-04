<?php

class BlogController {

    private $title="";
    private $error = "";
    private $option = "date";
    private $data = null;
    private $message="";

    public function __construct() {
        
    }

    public function invoke(): void {
        $viewClass='PostsListView';
        if(isset($_GET['option'])){
            $this->option=$_GET['option'];
        } 
        
        try {
            switch ($this->getRoute()) {
                case 1 :
                    $post = (new PostDao())->insertFromForm();                                 
                    $this->title = "Liste des articles";
                    $this->message ="";
                    $this->data = (new PostDao())->get($this->option);
                    break;
                case 2 :
                    $viewClass='PostView';                   
                    $comment = (new CommentDao())->insertFromForm();
                    $this->title = "Détail de l'article";
                    $this->message ="";
                    $id = $_GET['id'];
                    $this->data = (new PostDao())->getOne($id);                    
                    break;
                case 3 :
                    $viewClass='AddPostView';
                    $this->message ="";
                    $this->title = "Ajouter un article";     
                    break;
                default : exit ('Error!!');
            }
        }
        catch (BlogException $e) {
            
            $this->error = $e->getMessage();
        }

        (new $viewClass($this->title, $this->data, $this->error, $this->message))
            ->render();
    }

        // what to do? where are we?
    private function getRoute () : int {
        if (! isset ($_GET['route']))
            return 1;
        return $_GET['route'];;
    }
}