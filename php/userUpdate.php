<?php
    session_start();
    if(isset($_SESSION["loggedin_user"]) && $_SESSION["loggedin_user"]==true && $_SESSION["username_user"]==$_SESSION["getusername_user"] && $_SESSION["id_user"]==$_SESSION["getid_user"])
    {
        require_once 'config.php';
        if(isset($_POST['change_password'])){
            echo 'succes';
            $id_user=$_SESSION['id_user'];
            $pass=$_POST['password_forget'];
            $password=password_hash($pass, PASSWORD_DEFAULT);
            $change_password=$bdd->prepare("UPDATE users SET password=:password WHERE id=:id_user");
            $change_password->bindParam(':password',$password);
            $change_password->bindParam(':id_user',$id_user);
            if($change_password->execute()){
                header('Location: ../index.php');
            }
        }
    }else{
        header('Location:loginSignUp.php');
    }
