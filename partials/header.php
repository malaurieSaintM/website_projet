<?php
if(isset($_GET['logout']) && isset($_SESSION['user'])){
    unset($_SESSION["user"]);
    header('location:index.php?page=connexion');
    exit;
}
?>
<<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>


<nav class="navBar">
    <img id="logo" src="../assets/img/header/logo.jpg" alt="">

    <div class="menu">
        <a href="../views/homepage.php">Accueil </a>
        <a href="../views/information.php"> Informations </a>
        <a href="../views/event.php">Evènements</a>
        <a href="../views/contact.php"> Contactez-nous </a>
       <a href="../views/login-register.php">Connexion</a>
    </div>
</nav>

<nav class="navMobile">
    <div id="containerMob">
        <div class="menu">
            <i class="fas fa-bars"></i>
        </div>




    <div id="modal" class="openModal" >
        <div class="closeModal">
            <i class="fas fa-times"></i>
        </div>
        <div class="mobile">
            <a href="../views/homepage.php">Accueil </a>
            <a href="../views/information.php"> Informations </a>
            <a href="../views/event.php">Evènements</a>
            <a href="../views/contact.php"> Contactez-nous </a>
            <a href="../views/login-register.php">Connexion</a>
        </div>
    </div>
</nav>

<header class="imgHeader">
    <img id="" src="../assets/img/header/saintmalo.png" alt="" style="width: 100%;">
</header>

</body>
</html>