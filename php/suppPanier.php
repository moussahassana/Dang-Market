<?php
  if(isset($_SESSION["loggedin_user"]) && $_SESSION["loggedin_user"]==true && $_SESSION["username_user"]==$_SESSION["getusername_user"] && $_SESSION["id_user"]==$_SESSION["getid_user"])
  {
        session_start();
        require_once 'config.php';
        if(isset($_GET['idprod']))
        {
            $idprod=securiser($_GET['idprod']);
            $supp_pro_panier =$bdd->prepare('DELETE FROM panier WHERE produit=:idprod');
                if ($supp_pro_panier->execute([ ':idprod' => $idprod]))
                {
                    header('Location: panier.php');
                }
        }
        if(isset($_GET['vider_panier']))
        {
            $idprod=securiser($_GET['idprod']);
            $supp_pro_panier =$bdd->prepare('DELETE FROM panier');
                if ($supp_pro_panier->execute([':idprod' => $idprod]))
                {
                    header('Location: panier.php');
                }
        }  
    }else{
        header('Location: ../index.php')
    }
?>
