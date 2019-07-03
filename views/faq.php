<?php require_once('../tools/common.php');
$db = dbConnect();

require "../partials/header.php";
$recupCat = $db->query('SELECT * FROM categories_faq');
$categories = $recupCat->fetchAll();
$recupFaq = $db->query('SELECT * FROM questions_faq');
$questRep = $recupFaq->fetchAll();
$recupAnsFaq = $db->query('SELECT * FROM answers_faq');
$questRep = $recupAnsFaq->fetchAll();
?>
    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <title> FAQ | Ville de Saint Malo</title>
</head>
<body>

<div class="containerImgBck">
    <div class="innerTxtImgBck">FOIRE AUX QUESTIONS</div>
</div>

<?php if ($questRep): ?>
    <?php foreach ($categories as $cat): ?>
        <h2><?= $cat['name']; ?></h2>
        <?php foreach ($questRep as $faq): ?>
            <?php if ($cat['id'] == $faq['category_id']): ?>
                <button class="accordion"><?= $faq['questions']; ?></button>
                <div class="panel">
                    <p><?= $faq['answers']; ?></p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endif; ?>
<script>
    let acc = document.getElementsByClassName("accordion");
    let i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            let panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
</body>

<?php require  "../partials/footer.php";?>