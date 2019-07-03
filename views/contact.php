<?php

function motifs(){
    $db = dbConnect();

    $queryProblems = $db->query('SELECT * from type_problems');
    $problems = $queryProblems->fetchAll();

    return $problems;
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <title>Contact</title>
</head>
<body>
<?php require '../partials/header.php'; ?>
    <div class="alignForm">
        <form method="post" action="">
            <label for="username">Nom</label>
            <input type="text" id="username" name="username" placeholder="saisir votre nom" autocomplete="off" required />

            <label for="Email">Email</label>
            <input type="Email" id="Email" name="Email" placeholder="saisir votre Email" autocomplete="off" required />

            <select id="services" name="services">
                <option value="voirie">voirie</option>
                <option value="signalisation">signalisation</option>
                <option value="espaces verts">espaces verts</option>
                <option value="propreté">propreté</option>
                <option value="autre">autre</option>
            </select>
            <textarea id="subject" name="subject" placeholder="Ecrivez votre message ici.."></textarea>
            <input type="submit" name="submit" value="Envoyer" />

        </form>
    </div>


<script>

</script>


<?php require '../partials/footer.php'; ?>
</body>
</html>