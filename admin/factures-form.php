<?php
require_once ('./tools-admin/db-admin.php');
if (isset($_POST['save'])) {
    if (!$_FILES['facture']['error'] == 4 && !empty($_POST['factureDate']) && !empty($_POST['usersList'])) {
        if (filter_input(INPUT_POST, 'usersList', FILTER_VALIDATE_INT)) {
            $date = date_parse($_POST['factureDate']);
            if (checkdate($date['month'], $date['day'], $date['year'])) {
                $allowed_extensions = ['pdf'];
                $my_file_extension = pathinfo($_FILES['facture']['name'], PATHINFO_EXTENSION);

                if (in_array($my_file_extension, $allowed_extensions)) {
                    do {
                        $new_file_name = rand();
                        $destinationFacture = '../assets/factures clients/' . $new_file_name . '.' . $my_file_extension;
                        $new_file_name_extension = $new_file_name . '.' . $my_file_extension;

                    } while (file_exists($destinationFacture));
                    $result = move_uploaded_file($_FILES['facture']['tmp_name'], $destinationFacture);

                    $queryInsertCategory = $db->prepare('INSERT INTO factures (name, date, user_id) VALUES (?, ?, ?)');
                    $queryInsertCategory->execute([
                        $new_file_name_extension,
                        $_POST['factureDate'],
                        $_POST['usersList']
                    ]);

                    if ($queryInsertCategory) {
                        header('location:factures-list.php');
                        exit;
                    } else {
                        $message = 'Erreur.';
                    }
                } else {
                    $message = "Format de l'image incorrect";
                }
            }
            else{
                $message = "L'information fournis n'est pas une date";
            }
        }
        else{
            $message = "Erreur lors de la selection";
        }
    }
    else {
        $message = "Tous les champs sont obligatoire";
    }
}
if(isset($_GET['facture_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){
    $query = $db->prepare('SELECT * FROM factures WHERE id = ?');
    $query->execute(array($_GET['facture_id']));
    $recupFactureUser = $query->fetch();

    if ($recupFactureUser == false){
        header('location:factures-list.php');
        exit;
    }
}

if (isset($_POST['update'])){
    if (!$_FILES['facture']['error'] == 4 && !empty($_POST['factureDate']) && !empty($_POST['usersList'])) {
        if (filter_input(INPUT_POST, 'usersList', FILTER_VALIDATE_INT)) {
            $date = date_parse($_POST['factureDate']);
            if (checkdate($date['month'], $date['day'], $date['year'])) {
                $allowed_extensions = ['pdf'];
                $my_file_extension = pathinfo($_FILES['facture']['name'], PATHINFO_EXTENSION);

                if (in_array($my_file_extension, $allowed_extensions)) {
                    $queryFactures = $db->prepare('SELECT name FROM factures WHERE id = ?');
                    $queryFactures->execute([
                        $_POST['id']
                    ]);
                    $delFacture = $queryFactures->fetch();

                    $destination = '../assets/factures clients/';
                    unlink($destination . $delFacture['name']);

                    do {
                        $new_file_name = rand();
                        $destinationFacture = '../assets/factures clients/' . $new_file_name . '.' . $my_file_extension;
                        $new_file_name_extension = $new_file_name . '.' . $my_file_extension;

                    } while (file_exists($destinationFacture));
                    $result = move_uploaded_file($_FILES['facture']['tmp_name'], $destinationFacture);

                    $queryUpdateFacture = $db->prepare('UPDATE factures SET 
                        name = :name,
                        date = :date,
                        user_id = :userId
                        WHERE id = :id'
                    );
                    $resultFacture = $queryUpdateFacture->execute([
                        'name' => $new_file_name_extension,
                        'date' => $_POST['factureDate'],
                        'userId' => $_POST['usersList'],
                        'id' => $_POST['id']
                    ]);

                    if ($resultFacture) {
                        header('location:factures-list.php');
                        exit;
                    } else {
                        $message = 'Erreur.';
                    }
                } else {
                    $message = "Format de l'image incorrect";
                }
            }
            else{
                $message = "L'information fournis n'est pas une date";
            }
        }
        else{
            $message = "Erreur lors de la selection";
        }
    }
    elseif ($_FILES['facture']['error'] == 4 && !empty($_POST['factureDate']) && !empty($_POST['usersList'])) {
        if (filter_input(INPUT_POST, 'usersList', FILTER_VALIDATE_INT)) {
            $date = date_parse($_POST['factureDate']);
            if (checkdate($date['month'], $date['day'], $date['year'])) {
                $queryUpdateFacture = $db->prepare('UPDATE factures SET 
                    date = :date,
                    user_id = :userId
                    WHERE id = :id'
                );
                $resultFacture = $queryUpdateFacture->execute([
                    'date' => $_POST['factureDate'],
                    'userId' => $_POST['usersList'],
                    'id' => $_POST['id']
                ]);

                if ($resultFacture) {
                    header('location:factures-list.php');
                    exit;
                } else {
                    $message = 'Erreur.';
                }
            }
            else{
                $message = "L'information fournis n'est pas une date";
            }
        }
        else{
            $message = "Erreur lors de la selection";
        }
    }
    else {
        $message = "Tous les champs sont obligatoire";
    }
}
$query = $db->query('SELECT id,lastname FROM user ORDER BY id DESC');
$resultUsers = $query->fetchall();
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Administration des factures</title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">
			<?php require 'partials/header.php'; ?>
			<div class="row my-3 index-content">
				<?php require 'partials/nav.php'; ?>
				<section class="col-9">
					<header class="pb-3">
                        <h4><?php if(isset($recupFactureUser)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une facture</h4>
					</header>

					<?php if(isset($message)):?>
                        <div class="bg-danger text-white">
                            <?= $message; ?>
                        </div>
					<?php endif; ?>

					<form action="factures-form.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="facture">Renseignez une facture <b class="text-danger">*</b></label>
                            <input class="form-control" type="file" id="facture" name="facture">
                        </div>

                        <?php if(isset($recupFactureUser['name'])) :?>
                            <p><?= $recupFactureUser['name']; ?></p>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="factureDate">Renseignez une date pour la facture <b class="text-danger">*</b></label>
                            <input class="form-control" type="date" value="<?= isset($recupFactureUser) ? htmlentities($recupFactureUser['date']) : '';?>" id="factureDate" name="factureDate">
                        </div>

						<div class="form-group">
							<label for="usersList">Selectionnez un utilisateur à qui sera dédié la facture<b class="text-danger">*</b></label>
							<select class="form-control" name="usersList" id="usersList">
                                <option value="">Choisissez à quel utilisateur adresser cette facture</option>
                                <?php foreach ($resultUsers as $user): ?>
                                    <?php
                                        if (isset($_GET['facture_id'])) {
                                            $selectedUser = $db->prepare('SELECT * FROM factures WHERE id = ? AND user_id = ?');
                                            $selectedUser->execute(array($_GET['facture_id'], $user['id']));
                                            $recupUser = $selectedUser->fetch();
                                        }
                                    ?>
								    <option value="<?= $user['id']; ?>" <?= isset($_GET['facture_id']) && $recupUser ? 'selected' : ' '; ?> ><?= $user['lastname']; ?></option>
                                <?php endforeach; ?>
							</select>
						</div>

                        <div class="text-right">
                            <?php if(isset($recupFactureUser)): ?>
                                <input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />
                            <?php else: ?>
                                <input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
                            <?php endif; ?>
                        </div>

                        <?php if(isset($recupFactureUser)): ?>
                            <input type="hidden" name="id" value="<?= $recupFactureUser['id'];?>" />
                        <?php endif; ?>
					</form>
				</section>
			</div>
		</div>
  </body>
</html>