<?php
require_once '../tools/common.php';
if(isset($_POST['dateEvent'])) {
    $db = dbConnect();
    $queryEvents = $db->prepare('SELECT * FROM event WHERE published_date = ?' );
    $queryEvents->execute(array($_POST['dateEvent']));
    $getEvents = $queryEvents->fetchAll();
}

?>
<?php require "../partials/header.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <title> Actualités | Ville de Villejuif</title>
</head>
<body>

<div class="alignForm">
    <form class="datepicker" method="post">
        Evenements
        <input type="date" name="dateEvent">
        <input type="submit" name="sendDate">
    </form>
    <div style="display: flex; width: 100%; flex-direction: column">

        <?php foreach ($getEvents as $Event): ?>
            <div>
                <p><?= $Event['title']; ?></p>
                <p><?= $Event['resume']; ?></p>
                <p><?= $Event['content']; ?></p>
                <img src="assets/image/<?= $Event['image']?>">
            </div>
        <?php endforeach; ?>

    </div>
</div>


<?php require "../partials/footer.php";?>