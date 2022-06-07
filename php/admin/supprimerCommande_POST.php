<?php
    session_start();
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        require_once '../config.php';
        $numcom=securiser($_GET['numcom']);
        $supp_commande =$bdd->prepare('DELETE FROM commande WHERE numcom=:numcom');
            if ($supp_commande->execute([ ':numcom' => $numcom]))
            {
                header('Location: gestioncommande.php');
            }
    } else {
            header('Location: index.php');
    }
?>
