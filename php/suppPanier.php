<?php
    session_start();
    if(isset($_GET['idprod']))
    {
        require_once 'config.php';
        $idprod=securiser($_GET['idprod']);
        $supp_pro_panier =$bdd->prepare('DELETE FROM panier WHERE produit=:idprod');
            if ($supp_pro_panier->execute([ ':idprod' => $idprod]))
            {
                header('Location: panier.php');
            }
    }
    if(isset($_GET['vider_panier']))
    {
        require_once 'config.php';
        $idprod=securiser($_GET['idprod']);
        $supp_pro_panier =$bdd->prepare('DELETE FROM panier');
            if ($supp_pro_panier->execute([':idprod' => $idprod]))
            {
                header('Location:panier.php');
            }
    }  
?>
