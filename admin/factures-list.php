<?php
require_once ('./tools-admin/db-admin.php');

if(isset($_GET['facture_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){
    $queryFacture = $db->prepare('SELECT name FROM factures WHERE id = ?');
    $queryFacture->execute([
        $_GET['facture_id']
    ]);
    $delFacture = $queryFacture->fetch();

    if (!empty($delFacture['name'])) {
        $destination = '../assets/factures clients/';
        unlink($destination . $delFacture['name']);
    }

    $query = $db->prepare('DELETE FROM factures WHERE id = ?');
    $result = $query->execute([
        $_GET['facture_id']
    ]);

    if($result){
        $message = "Suppression efféctuée.";
    }
    else{
        $message = "Impossible de supprimer la séléction.";
    }
}
$query = $db->query('SELECT * FROM factures ORDER BY id DESC');
$factures = $query->fetchall();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administration des factures </title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>
    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>
        <section class="col-9">

            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des factures </h4>
                <a class="btn btn-primary" href="factures-form.php">Ajouter une facture</a>
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
                    <th>Nom</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(count($factures) > 0): ?>
                        <?php foreach($factures as $facture): ?>
                            <tr>
                                <th><?= htmlentities($facture['id']); ?></th>
                                <td><?= htmlentities($facture['name']); ?></td>
                                <td><?= htmlentities($facture['date']); ?></td>
                                <td>
                                    <a href="factures-form.php?facture_id=<?= $facture['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                                    <a onclick="return confirm('Are you sure?')" href="factures-list.php?facture_id=<?= $facture['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Aucune facture enregistrée.
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
</body>
</html>
