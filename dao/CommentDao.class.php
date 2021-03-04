<?php
class CommentDao extends Dao {
    const SQL_INSERT = 'INSERT INTO `Comment` (`NickName`, `Contents`, `CreationTimestamp`, `Post_Id`) VALUES (?,?,?,?)'; 
    const SQL_SEL_COM = 'SELECT `Comment`.`Id`,`NickName`, `Comment`.`Contents`, `Comment`.`CreationTimestamp`, `Post_Id` FROM `Comment` WHERE `Post_Id` = :id ORDER BY `Comment`.`CreationTimestamp`'; 
    
    public function get($id) : array {
        $pdo = Dao::connect();
        $stmtComm = $pdo->prepare(self::SQL_SEL_COM);
        if (! $stmtComm->execute(array(':id' => $id)))
            throw new BlogException(1,"Cannot get the list of comments");
        $cs = $stmtComm->fetchAll(PDO::FETCH_ASSOC);
        $comments = [];
        foreach ($cs as $c) {
            $comments [] = new Comment($c["NickName"], $c["Contents"], $c["CreationTimestamp"], $c["Post_Id"]);
        }
        return $comments;
    }


    public function insertFromForm(){
        if (isset($_POST['submit'])) {
            if (
                isset($_POST['nickName'])&&
                isset($_POST['comment']) &&
                $_POST['nickName'] !="" &&
                $_POST['comment'] !=""
            ) {
                $date = Date('Y-m-d H:i:s');
                $id = $_GET['id'];
                $comment = (new Comment($_POST["nickName"], $_POST["comment"], $date, $id));
                $commentDao = $this->insert($comment);
            } else{
                echo "erreur";
            }
        }
    }

    public function insert (Object $comment) : bool {
        $stmt= Dao::connect()->prepare(self::SQL_INSERT);
        if (! $stmt->execute([$comment->getNickName(),$comment->getContents(), $comment->getCreationDate(), $comment->getPostId()]))
            throw new BlogException(2,"Cannot insert the comment");
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