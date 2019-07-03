<?php
require_once ('./tools-admin/db-admin.php');
$queryCategories = $db ->query('SELECT * FROM category_faq');
$categoriesFAQ = $queryCategories->fetchAll();


if(isset($_POST['saveFAQ'])){
    if (!empty($_POST['question']) && !empty($_POST['answer']) && !empty($_POST['categoryFaq'])) {
        if (filter_input(INPUT_POST, 'categoryFaq', FILTER_VALIDATE_INT)) {
            $query = $db->prepare('INSERT INTO faq (questions,responses,categorie_id) VALUES (?, ? ,?)');
            $newFAQ = $query->execute([
                ucfirst($_POST['question']),
                ucfirst($_POST['answer']),
                $_POST['categoryFaq']
            ]);

            if ($newFAQ) {
                header('location:faq-list.php');
                exit;
            } else {
                $message = "Impossible d'enregistrer la nouvelle FAQ";
            }
        }
        else{
            $message = "Erreur lors de la selection de la catégorie";
        }
    }
    else{
        $message = "Tous les champs sont obligatoire";
    }
}

if(isset($_GET['faq_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){
    $query = $db->prepare('SELECT * FROM faq WHERE id = ?');
    $query->execute(array($_GET['faq_id']));
    $category = $query->fetch();

    if ($category == false){
        header('location:faq-list.php');
        exit;
    }
}

if(isset($_POST['update'])){
    if (!empty($_POST['question']) && !empty($_POST['answer']) && !empty($_POST['categoryFaq'])) {
        if (filter_input(INPUT_POST, 'categoryFaq', FILTER_VALIDATE_INT) && filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)) {
            $query = $db->prepare('UPDATE faq SET
                questions = :questions,
                responses = :responses,
                categorie_id = :categorieId
                WHERE id = :id'
            );

            $result = $query->execute([
                'questions' => $_POST['question'],
                'responses' => $_POST['answer'],
                'categorieId' => $_POST['categoryFaq'],
                'id' => $_POST['id']
            ]);

            if ($result) {
                header('location:faq-list.php');
                exit;
            } else {
                $message = "Impossible d'enregistrer la nouvelle categorie...";
            }
        }
        else{
            $message = "Erreur lors de l'enregistrement";
            $delai=2;
            $url='faq-list.php';
            header("Refresh: $delai;url=$url");
        }
    }
    else{
        $message = "Impossible d'enregistrer une nouvelle FAQ vide";
        $delai=2;
        $url='faq-list.php';
        header("Refresh: $delai;url=$url");
    }
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration des FAQ</title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">
			<?php require 'partials/header.php'; ?>
			<div class="row my-3 index-content">
				<?php require 'partials/nav.php'; ?>
				<section class="col-9">
					<header class="pb-3">
						<h4><?php if(isset($category)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une FAQ</h4>
					</header>

					<?php if(isset($message)):?>
                        <div class="bg-danger text-white">
                            <?= $message; ?>
                        </div>
					<?php endif; ?>

					<form action="faq-form.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="question">Question :</label>
							<input class="form-control" value="<?= isset($category) ? htmlentities($category['questions']) : '';?>" type="text" placeholder="Question" name="question" id="question" />
						</div>

                        <div class="form-group">
                            <label for="answer">Réponse :</label>
                            <textarea class="form-control" name="answer" id="answer" placeholder="Réponse"><?= isset($category) ? htmlentities($category['responses']) : '';?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="categoryFaq"> Liste des catégories FAQ</label>
                            <select class="form-control" name="categoryFaq" id="categoryFaq">
                                <option value="">Choissisez une catégorie</option>
                                <?php foreach($categoriesFAQ as $categoryFAQ) : ?>
                                    <?php
                                        if (isset($_GET['faq_id'])) {
                                            $selectedCategory = $db->prepare('SELECT * FROM faq WHERE id = ? AND categorie_id = ?');
                                            $selectedCategory->execute(array($_GET['faq_id'], $categoryFAQ['id']));
                                            $recupCategory = $selectedCategory->fetch();
                                        }
                                    ?>
                                    <option value="<?= $categoryFAQ['id']; ?>" <?= isset($_GET['faq_id']) && $recupCategory ? 'selected' : ' '; ?>><?= $categoryFAQ['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

						<div class="text-right">
							<?php if(isset($category)): ?>
							    <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
							<?php else: ?>
							    <input class="btn btn-success" type="submit" name="saveFAQ" value="Enregistrer" />
							<?php endif; ?>
						</div>

						<?php if(isset($category)): ?>
						    <input type="hidden" name="id" value="<?= $category['id'];?>" />
						<?php endif; ?>
					</form>
				</section>
			</div>
		</div>
	</body>
</html>
