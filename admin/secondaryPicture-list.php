<?php
require_once ('./tools-admin/db-admin.php');
if(isset($_GET['secondaryPicture_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $queryImage = $db->prepare('SELECT * FROM image WHERE id = ?');
    $queryImage->execute([
        $_GET['secondaryPicture_id']
    ]);
    $delImageSecondary = $queryImage->fetch();

    if (!empty($delImageSecondary['name'])) {
        $destination = '../assets/images/imagesSecondaire/';
        unlink($destination . $delImageSecondary['name']);
    }

    $queryImageSecondary = $db->prepare('DELETE FROM image WHERE id = ?');
    $queryImageSecondary->execute([
        $_GET['secondaryPicture_id']
    ]);

    if($queryImageSecondary){
        $message = "Suppression efféctuée.";
    }
    else{
        $message = "Impossible de supprimer la séléction.";
    }
}
$query = $db->query('SELECT * FROM image ORDER BY id DESC');
$imagesSecondary = $query->fetchall();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration des images secondaire</title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">
			<?php require 'partials/header.php'; ?>
			<div class="row my-3 index-content">
				<?php require 'partials/nav.php'; ?>
				<section class="col-9">
					<header class="pb-4 d-flex justify-content-between">
						<h4>Liste des images secondaire</h4>
						<a class="btn btn-primary" href="secondaryPicture-form.php">Ajouter des images secondaire</a>
					</header>
					<?php if(isset($message)):?>
					<div class="bg-success text-white p-2 mb-4">
						<?= $message; ?>
					</div>
					<?php endif; ?>

                    <?php if(count( $imagesSecondary) >0 ): ?>
                        <div class="container" style="display: flex; align-items: flex-end; justify-content: space-around;flex-wrap: wrap;">
                            <?php foreach($imagesSecondary as $secondary): ?>
                                <div class="card mt-3" style="width: 18rem;" >
                                    <img src="../assets/images/imagesSecondaire/<?= $secondary['name']; ?>" class="card-img-top" style="object-fit: cover; height: 375px" alt="...">
                                    <div class="card-body">
                                        <p class="text-center"><?= $secondary['name']; ?></p>
                                    </div>
                                    <div style="text-align: center;">
                                        <a href="secondaryPicture-form.php?secondaryPicture_id=<?= $secondary['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                                        <a onclick="return confirm('Are you sure?')" href="secondaryPicture-list.php?secondaryPicture_id=<?= $secondary['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        Aucun image secondaire enregistré.
                    <?php endif; ?>
				</section>
			</div>
		</div>
	</body>
</html>