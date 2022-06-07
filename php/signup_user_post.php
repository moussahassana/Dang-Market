<?php
    session_start();
    require_once 'config.php';

        date_default_timezone_set("Africa/Douala");
        $date_creation=date("Y-m-d H:i:s");
        $username=securiser($_POST['username_signup']);
        $email=securiser($_POST['email_signup']);
        $tel=securiser($_POST['tel_signup']);
        $password_hash=securiser($_POST['password_signup']);
        $password= password_hash($password_hash, PASSWORD_DEFAULT);
        $signup_user=$bdd->prepare("INSERT INTO users(username, email, tel, password,date_creation) VALUES (:username,:email,:tel,:password,:date_creation)");
        $signup_user->bindParam(':username',$username);
        $signup_user->bindParam(':email',$email);
        $signup_user->bindParam(':tel',$tel);
        $signup_user->bindParam(':password',$password);
        $signup_user->bindParam(':date_creation',$date_creation);
        if($signup_user->execute()){
            header('Location: loginSignUp.php');
        }
?>