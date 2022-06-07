<?php
    session_start();
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
            require_once '../config.php';
            $id=securiser($_GET['userid']);
            $supp_produit_req =$bdd->prepare('DELETE FROM users WHERE users.id=:id');
            $supp_produit_req->bindParam(':id',$id);
            DELETE FROM `users` WHERE `users`.`id` = 6
            if ($supp_produit_req->execute())
            {
               header('Location: userAccount.php');
            }
        
    } else {
            header('Location: index.php');
    }
?>
