<?php

try
{
    $servername="localhost";
    $dbname="dang_market";
    $username_db="root";
    $password_db="";
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname",$username_db,$password_db);
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    /* 
    $ftp_serveur = ";
    $ftp_con = ftp_connect($ftp_serveur) or die("Echec de connexion avec $ftp_serveur");
    $ftp_username="";
    $ftp_userpass="";
    $login = ftp_login($ftp_con, $ftp_username, $ftp_userpass);
    */
}
catch(PDOException $e)
{
die('Echec de connexion : '.$e->getMessage());
}

function securiser($donnees)
{
    $donnees=trim($donnees);
    $donnees=stripcslashes($donnees);
    $donnees=strip_tags($donnees);
    return($donnees);
}
?>
