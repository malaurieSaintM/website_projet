<?php
require_once ('./tools-admin/db-admin.php');

if(isset($_GET['faq_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

    $query = $db->prepare('DELETE FROM faq WHERE id = ?');
    $result = $query->execute([
        $_GET['faq_id']
    ]);

    if($result){
        $message = "Suppression efféctuée.";
    }
    else{
        $message = "Impossible de supprimer la séléction.";
    }
}

$query = $db->query('SELECT * FROM faq ORDER BY id DESC');
$faqs = $query->fetchall();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration des FAQ </title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">
			<?php require 'partials/header.php'; ?>
			<div class="row my-3 index-content">
				<?php require 'partials/nav.php'; ?>
				<section class="col-9">

					<header class="pb-4 d-flex justify-content-between">
						<h4>Liste des FAQ </h4>
						<a class="btn btn-primary" href="faq-form.php">Ajouter une FAQ</a>
					</header>

					<?php if(isset($message)):?>
                        <div class="bg-success text-white p-2 mb-4">
                            <?= $message; ?>
                        </div>
					<?php endif; ?>

					<table class="table table-striped">
						<thead  class="thead-dark">
							<tr>
								<th>#</th>
								<th>Questions</th>
								<th>Réponses</th>
							</tr>
						</thead>
						<tbody>
							<?php if(count($faqs) > 0): ?>
                                <?php foreach($faqs as $faq): ?>
                                <tr>
                                    <th><?= htmlentities($faq['id']); ?></th>
                                    <td><?= htmlentities($faq['questions']); ?></td>
                                    <td><?= htmlentities($faq['responses']); ?></td>
                                    <td>
                                        <a href="faq-form.php?faq_id=<?= $faq['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                                        <a onclick="return confirm('Are you sure?')" href="faq-list.php?faq_id=<?= $faq['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
							<?php else: ?>
								Aucune FAQ enregistrée.
							<?php endif; ?>
						</tbody>
					</table>
				</section>
			</div>
		</div>
	</body>
</html>
