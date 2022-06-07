<?php
require_once 'config.php';
$idprod=securiser($_GET['idprod']);
$supp_pro_favoris =$bdd->prepare('DELETE FROM user_favoris WHERE produit=:idprod');
    if ($supp_pro_favoris->execute([ ':idprod' => $idprod]))
    {
        header('Location: Myfavoris.php');
    }
?>