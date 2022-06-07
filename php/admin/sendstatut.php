<?php 
    require_once '../config.php';
    $numcom=trim($_POST['numcom']);
    $statut=$_POST['statut'];
    $update_statut_req=$bdd->prepare('UPDATE commande SET statut=:statut WHERE numcom=:numcom');
    $update_statut_req->bindParam(':statut',$statut);
    $update_statut_req->bindParam(':numcom',$numcom);
    $update_statut_req->execute();
?>