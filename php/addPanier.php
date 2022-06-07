<?php
    session_start();
    require_once 'config.php';
        $_SESSION['user_id']=1;
        $idprod=securiser($_POST['id_prod']);
        $user=securiser($_SESSION['user_id']);
        $add_panier=$bdd->prepare("INSERT INTO panier (user,produit) VALUES (:user,:id_prod)");
        $add_panier->bindParam(':user',$user);
        $add_panier->bindParam(':id_prod',$idprod);
        $add_panier->execute();
        header('Location : ../index.php')
    
?>