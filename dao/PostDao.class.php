<?php
class PostDao extends Dao {
    const SQL_SEL_ALL_TITLE = 'SELECT `Id`,`Title`,`Contents`,`CreationTimestamp`,`Author`,`img` FROM `Post` ORDER BY `Title`';
    const SQL_SEL_ALL_DATE = 'SELECT `Id`,`Title`,`Contents`,`CreationTimestamp`,`Author`,`img` FROM `Post` ORDER BY `CreationTimestamp`';
    const SQL_SEL_ONE = 'SELECT `Id`,`Title`,`Contents`,`CreationTimestamp`,`Author`,`img` FROM `Post` WHERE `Id`= :id';
    const SQL_SEL_ID = 'SELECT max(Id)+1 AS idPost FROM `Post`';
    const SQL_INSERT = 'INSERT INTO `Post` (`Id`, `Title`, `Contents`, `CreationTimestamp`, `Author`, `img`) VALUES (?,?,?,?,?,?)';
    
    public function get($option) : array {
        $pdo = Dao::connect();
        if($option == "date"){
            $stmt = $pdo->prepare(self::SQL_SEL_ALL_DATE);
        } elseif ($option="title"){
            $stmt = $pdo->prepare(self::SQL_SEL_ALL_TITLE);
        }
        
        if (! $stmt->execute())
            throw new BlogException(3,"Cannot get the list of articles");
        $ps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $posts = [];        
        
        foreach ($ps as $p) {      
            $comments = (new CommentDao())->get($p["Id"]);
            $posts [] = new Post($p["Id"], $p["Title"], $p["Contents"], $p["CreationTimestamp"], $p["Author"],$p["img"], $comments);
        }
        return $posts;
    }
    
    public function getMaxId(){
        $pdo = Dao::connect();
        $stmt = $pdo->prepare(self::SQL_SEL_ID);
        if (! $stmt->execute())
            throw new BlogException(5,"Cannot get the article id");
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        return $id['idPost'];
    }

    public function getOne($id){
        $pdo = Dao::connect();        
        $stmtArticle = $pdo->prepare(self::SQL_SEL_ONE);        
        if (! $stmtArticle->execute(array(':id' => $id)))           
            throw new BlogException(3,"Cannot get the article requested");
        $p = $stmtArticle->fetch(PDO::FETCH_ASSOC);
        $comments = (new CommentDao())->get($p["Id"]);
        $post = new Post($p["Id"], $p["Title"], $p["Contents"], $p["CreationTimestamp"], $p["Author"],$p["img"], $comments);
        return $post;        
    }

    public function insertFromForm(){
        if (isset($_POST['submit'])) {
            if (
                isset($_POST['author'])&&
                isset($_POST['title']) &&
                isset($_POST['content'])&&
                isset($_POST['image']) &&
                $_POST['author'] !="" &&
                $_POST['title'] !="" &&
                $_POST['content'] !="" &&
                $_POST['image'] !=""
            ) {
                $date = Date('Y-m-d H:i:s');
                $id= $this->getMaxId();
                $post = (new Post($id, $_POST["title"], $_POST["content"], $date, $_POST["author"], $_POST["image"], []));
                $this->insert($post);
                
            } else{
                echo "erreur";
            }
        }
    }
    public function insert (Object $post) : bool {
        
        $stmt= Dao::connect()->prepare(self::SQL_INSERT);
        if( ! $stmt->execute([$post->getId(),$post->getTitle(), $post->getContents(),$post->getCreationDate(), $post->getAuthor(), $post->getImg()]))
            throw new BlogException(4,"Cannot insert the article");
        return true;
    }

    public function delete () : bool {
        //todo
       return false;

    }
    public function update () : bool {
        // todo
       return false;

    }

}