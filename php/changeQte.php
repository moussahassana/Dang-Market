<?php
  if(isset($_SESSION["loggedin_user"]) && $_SESSION["loggedin_user"]==true && $_SESSION["username_user"]==$_SESSION["getusername_user"] && $_SESSION["id_user"]==$_SESSION["getid_user"])
  {
    session_start();
    require_once 'config.php';
        
        $qte_prod=securiser($_POST['qte_prod']);
        $id_prod=securiser($_POST['id_prod']);
        $user=securiser($_SESSION['id_user']);
        $update_qte_prod_panier=$bdd->prepare("UPDATE panier SET qte=:qte_prod WHERE user=:user AND produit=:id_prod");
        $update_qte_prod_panier->bindParam(':qte_prod',$qte_prod);
        $update_qte_prod_panier->bindParam(':user',$user);
        $update_qte_prod_panier->bindParam(':id_prod',$id_prod);
        $update_qte_prod_panier->execute();
  }else{
      header('Location:loginSignUp.php')
  }

?>