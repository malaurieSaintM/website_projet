!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= ucfirst($event['title']); ?></title>
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
<?php require '../partials/header.php'; ?>
<main class="articleId">
    <article>

        <h1><?= ucfirst($event['title']); ?></h1>

        <h3><?= ucfirst(strftime("%A %e %B %Y", strtotime($event['published_at']))); ?></h3>

        <div class="container">
            <img src="./assets/images/articles/<?= $event['image']; ?>" alt="">
            <p><?= ucfirst($event['content']); ?></p>
        </div>

        <?php if(isset($event['video']) AND !empty($event['video'])) : ?>
            <div class="container video">
                <iframe width="560" height="315" src="<?= $event['video']; ?>"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>
            </div>
        <?php endif; ?>

        <?php if(count($images) > 0) :?>
            <div class="secondaryPicture">
                <?php foreach ($images as $image): ?>
                    <img src="./assets/images/imagesSecondaire/<?= $image['name'];?>" alt="">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>
</main>
<?php require '../partials/footer.php'; ?>


</body>
</html>