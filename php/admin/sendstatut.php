<?php 
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        require_once '../config.php';
        $numcom=trim($_POST['numcom']);
        $statut=$_POST['statut'];
        $update_statut_req=$bdd->prepare('UPDATE commande SET statut=:statut WHERE numcom=:numcom');
        $update_statut_req->bindParam(':statut',$statut);
        $update_statut_req->bindParam(':numcom',$numcom);
        $update_statut_req->execute();
    } else {
        header('Location: loginSignUp.php');
    }
?>