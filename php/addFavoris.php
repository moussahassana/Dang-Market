<?php
    session_start();
    if(isset($_SESSION["loggedin_user"]) && $_SESSION["loggedin_user"]==true && $_SESSION["username_user"]==$_SESSION["getusername_user"] && $_SESSION["id_user"]==$_SESSION["getid_user"])
    {
        require_once 'config.php';
        $idprod=securiser($_POST['id_prod']);
        $user=securiser($_SESSION['id_user']);
        $add_favoris=$bdd->prepare("INSERT INTO user_favoris (user,produit) VALUES (:user,:id_prod)");
        $add_favoris->bindParam(':user',$user);
        $add_favoris->bindParam(':id_prod',$idprod);
        $add_favoris->execute();
    } else {
        echo'sign_up';
    }  
?>