<?php
    session_start();
    if(isset($_SESSION["loggedin_user"]) && $_SESSION["loggedin_user"]==true && $_SESSION["username_user"]==$_SESSION["getusername_user"] && $_SESSION["id_user"]==$_SESSION["getid_user"])
    {
        require_once 'config.php';
        $idprod=securiser($_POST['id_prod']);
        $user=securiser($_SESSION['id_user']);
        $add_panier=$bdd->prepare("INSERT INTO panier (user,produit) VALUES (:user,:id_prod)");
        $add_panier->bindParam(':user',$user);
        $add_panier->bindParam(':id_prod',$idprod);
        $add_panier->execute();
        
    } else {
        echo'sign_up';
    } 
    
?>