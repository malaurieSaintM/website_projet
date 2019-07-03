<?php
require_once ('./tools-admin/db-admin.php');
if (isset($_POST['save'])) {
    if (!$_FILES['picture']['error'] == 4) {
        if (filter_input(INPUT_POST, 'articleSelected', FILTER_VALIDATE_INT)) {
            $allowed_extensions = ['jpg', 'jpeg', 'gif ', 'png'];
            $my_file_extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

            if (in_array($my_file_extension, $allowed_extensions)) {
                do {
                    $new_file_name = rand();
                    $destinationSecondaryPicture = '../assets/images/imagesSecondaire/' . $new_file_name . '.' . $my_file_extension;
                    $new_file_name_extension = $new_file_name . '.' . $my_file_extension;

                } while (file_exists($destinationSecondaryPicture));
                $result = move_uploaded_file($_FILES['picture']['tmp_name'], $destinationSecondaryPicture);

                $queryInsertCategory = $db->prepare('INSERT INTO image (name, article_id) VALUES (?, ?)');
                $queryInsertCategory->execute([
                    $new_file_name_extension,
                    $_POST['articleSelected']
                ]);

                if ($queryInsertCategory) {
                    header('location:secondaryPicture-list.php');
                    exit;
                } else {
                    $message = 'Erreur.';
                }
            } else {
                $message = "Format de l'image incorrect";
            }
        }
        else{
            $message = "Erreur lors de la selection";
        }
    }
    else {
        $message = "Veuillez insérer une image";
    }
}
if(isset($_GET['secondaryPicture_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){
    $query = $db->prepare('SELECT * FROM image WHERE id = ?');
    $query->execute(array($_GET['secondaryPicture_id']));
    $recupSecondaryImage = $query->fetch();

    if ($recupSecondaryImage == false){
        header('location:secondaryPicture-list.php');
        exit;
    }
}
if (isset($_POST['update'])) {
    if (!$_FILES['picture']['error'] == 4) {
        if (filter_input(INPUT_POST, 'articleSelected', FILTER_VALIDATE_INT)) {
            $allowed_extensions = ['jpg', 'jpeg', 'gif ', 'png'];
            $my_file_extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

            if (in_array($my_file_extension, $allowed_extensions)) {
                $queryImageSelected = $db->prepare('SELECT * FROM image WHERE id = ?');
                $queryImageSelected->execute([
                    $_POST['id']
                ]);
                $delSecondPicture = $queryImageSelected->fetch();

                $destination = '../assets/images/imagesSecondaire/';
                unlink($destination . $delSecondPicture['name']);

                do {
                    $new_file_name = rand();
                    $destinationSecondaryPicture = '../assets/images/imagesSecondaire/' . $new_file_name . '.' . $my_file_extension;
                    $new_file_name_extension = $new_file_name . '.' . $my_file_extension;

                } while (file_exists($destinationSecondaryPicture));
                $result = move_uploaded_file($_FILES['picture']['tmp_name'], $destinationSecondaryPicture);

                $queryUpdateSecondaryPicture = $db->prepare('UPDATE image SET 
                    name = :name,
                    article_id = :articleId
                    WHERE id = :id'
                );
                $resultPicture = $queryUpdateSecondaryPicture->execute([
                    'name' => $new_file_name_extension,
                    'articleId' => $_POST['articleSelected'],
                    'id' => $_POST['id']
                ]);

                if ($resultPicture) {
                    header('location:secondaryPicture-list.php');
                    exit;
                } else {
                    $message = 'Erreur.';
                }
            } else {
                $message = "Format de l'image incorrect";
            }
        } else {
            $message = "Erreur lors de la selection";
        }
    }
    else{
        if ($_FILES['picture']['error'] == 4) {
            if (filter_input(INPUT_POST, 'articleSelected', FILTER_VALIDATE_INT)) {
                $queryUpdateInformation = $db->prepare('UPDATE image SET 
                article_id = :articleId
                WHERE id = :id'
                );
                $resultInfo = $queryUpdateInformation->execute([
                    'articleId' => $_POST['articleSelected'],
                    'id' => $_POST['id']
                ]);

                if ($resultInfo) {
                    header('location:secondaryPicture-list.php');
                    exit;
                }
                else {
                    $message = 'Erreur.';
                }
            }
            else {
                $message = "Erreur lors de la selection";
            }
        }
    }
}

$query = $db->query('SELECT id,title FROM article ORDER BY id DESC');
$resultArticles = $query->fetchall();
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
					<header class="pb-3">
                        <h4><?php if(isset($recupSecondaryImage)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une image secondaire</h4>
                    </header>

					<?php if(isset($message)):?>
                        <div class="bg-danger text-white">
                            <?= $message; ?>
                        </div>
					<?php endif; ?>

					<form action="secondaryPicture-form.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="image">Images : <b class="text-danger">*</b></label>
                            <input class="form-control" type="file" id="image" name="picture">

                            <?php if(isset($recupSecondaryImage['name'])) :?>
                                <img class="img-fluid py-4" src="../assets/images/imagesSecondaire/<?= $recupSecondaryImage['name']; ?>" alt="">
                            <?php endif; ?>
                        </div>

						<div class="form-group">
							<label for="articleSelected">Selectionnez un article pour lui attribuer les images secondaire <b class="text-danger">*</b></label>
							<select class="form-control" name="articleSelected" id="articleSelected">
                                <?php foreach ($resultArticles as $articles): ?>
                                    <?php
                                        if (isset($_GET['secondaryPicture_id'])) {
                                            $selectedImage = $db->prepare('SELECT * FROM image WHERE id = ? AND article_id = ?');
                                            $selectedImage->execute(array($_GET['secondaryPicture_id'], $articles['id']));
                                            $recupImage = $selectedImage->fetch();
                                        }
                                    ?>
								    <option value="<?= $articles['id']; ?>"<?= isset($_GET['secondaryPicture_id']) && $recupImage ? 'selected' : ' '; ?>><?= $articles['title']; ?></option>
                                <?php endforeach; ?>
							</select>
						</div>

                        <div class="text-right">
                            <?php if(isset($recupSecondaryImage)): ?>
                                <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
                            <?php else: ?>
                                <input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
                            <?php endif; ?>
                        </div>

                        <?php if(isset($recupSecondaryImage)): ?>
                            <input type="hidden" name="id" value="<?= $recupSecondaryImage['id'];?>" />
                        <?php endif; ?>
					</form>
				</section>
			</div>
		</div>
  </body>
</html>