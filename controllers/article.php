<?php
if(isset($_GET['article_id']) AND ctype_digit($_GET['article_id'])) {

    require_once ('../models/article.php');
    $event = getArticle($_GET['article_id']);
    $images = getSecondaryPicture($_GET['article_id']);
    require_once ('../views/article.php');
}
else{
    header('location:index.php');
    exit;
}