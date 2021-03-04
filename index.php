<?php
declare (strict_types=1);
        // main

require_once 'conf.inc.php';
require_once 'controller/BlogController.class.php';
require_once 'model/Post.class.php'; 
require_once 'model/Comment.class.php';
require_once 'exceptions/BlogException.class.php'; 
require_once 'dao/Dao.class.php';  
require_once 'dao/PostDao.class.php';  
require_once 'dao/CommentDao.class.php';
require_once 'view/Layout.class.php';
require_once 'view/PostView.class.php';
require_once 'view/PostsListView.class.php';
require_once 'view/AddPostView.class.php';

$controller = new BlogController();
$controller->invoke();
exit();
