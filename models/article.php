<?php
function getArticles($limit = false , $dateEvent = false){
    $db = dbConnect();

    $queryString = 'SELECT id,title,summary,image FROM article';
    $queryNextString = ' published_at <= NOW() AND is_published = 1 ORDER BY published_at DESC';

    $finalRequest = null;

    $queryParameters = [];

    if ($limit){
        $finalRequest = $queryString.' WHERE '.$queryNextString .' LIMIT '.$limit;
        $queryParameters = [];
    }
    elseif ($dateEvent){
        $finalRequest = $queryString.' WHERE '.' published_at = ? AND '.$queryNextString;
        $queryParameters[] = $dateEvent;
    }
    else{
        $finalRequest = $queryString.' WHERE '.$queryNextString;
        $queryParameters = [];
    }

    $queryArticles = $db->prepare($finalRequest);
    $queryArticles->execute($queryParameters);

    return $queryArticles->fetchAll();
}

function getArticle($getOneArticle){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM event WHERE published_at <= NOW() AND is_published = 1 AND id = ?');

    $query->execute( array( $getOneArticle ) );
    $oneArticle = $query->fetch();

    if($oneArticle == false){
        header('location:index.php');
        exit;
    }
    return $oneArticle;
}

function getSecondaryPicture($getPictures){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM event WHERE article_id = ? ORDER BY id ASC');
    $query->execute( array( $getPictures ) );

    $secondaryPictures = $query->fetchAll();

    return $secondaryPictures;
}