<?php
    session_start();
    require_once 'config.php';
    if(isset($_SESSION["loggedin_user"]) && $_SESSION["loggedin_user"]==true && $_SESSION["username_user"]==$_SESSION["getusername_user"] && $_SESSION["id_user"]==$_SESSION["getid_user"])
    {
    $idprod=securiser($_GET['idprod']);
    $supp_pro_favoris =$bdd->prepare('DELETE FROM user_favoris WHERE produit=:idprod AND user=:userid');
    $supp_pro_favoris->bindParam(':idprod',$idprod);
    $supp_pro_favoris->bindParam(':userid',$userid);
        if ($supp_pro_favoris->execute())
        {
            header('Location: Myfavoris.php');
        }
        <?php 
    } else {
        header('Location: loginSignUp.php');
    } ?>
?>