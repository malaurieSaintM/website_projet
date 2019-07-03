<?php
require_once '../models/article.php';
if (isset($_POST['send'])){
    if (!empty($_POST['eventDate'])) {
        $date = date_parse($_POST['eventDate']);
        if (checkdate($date['month'], $date['day'], $date['year'])) {
            $allArticles = getArticles($limit = false, $_POST['eventDate']);

        }
        else{
            $message = 'L\'information fournis n\'est pas une date';
            $allArticles = getArticles($limit = false, false);

        }
    }
    else{
        $message = 'Veuillez fournir une date pour trier les articles';
        $allArticles = getArticles($limit = false, false);

    }
}
elseif (isset($_POST['allArticles'])){
    $allArticles = getArticles($limit = false, false);

}
else{
    $allArticles = getArticles($limit = false, false);
}
require_once ('../views/event.php');