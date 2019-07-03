<?php require_once('../partials/header.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>

<div class="home">

    <h1><span style="color: #006AB3">Actualités</span> Malouines</h1>
    <!-- Slideshow container -->
    <div class="carousel" id="carous">
        <input type="radio" name="carArticle" value="1" checked>
        <div>
            <img src="../assets/img/evenement/route.jpg">

        </div>

        <input type="radio" name="carArticle" value="2">
        <div>
            <img src="../assets/img/evenement/actu1.jpg">

        </div>

        <input type="radio" name="carArticle" value="3">
        <div>
            <img src="../assets/img/evenement/actu2.jpg" >

        </div>
    </div>
    <button id="actbtn"><a href="event.php">Voir toutes les actualités</a></button>
</div>
</body>
<?php require_once('../partials/footer.php'); ?>


