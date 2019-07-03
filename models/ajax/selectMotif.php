<?php

try{
    return $db = new PDO('mysql:host=localhost;dbname=city_malaurie;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exception)
{
    die( 'Erreur : ' . $exception->getMessage() );
}

$response = new \stdClass();
$motif = $_POST['motif'];

if (isset($motif) AND !empty($motif)){
    $squeryDetails = $db->prepare('SELECT * FROM choice_type_problems WHERE motif_id = ?');

    $squeryDetails->execute( array( $motif ) );

    $response->type = 1;
    $response->details = $squeryDetails->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($response);
}
