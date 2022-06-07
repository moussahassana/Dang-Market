<?php
session_start();
if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
    
        require_once '../config.php';
        //require_once 'ftp.php';
        $editercomreq=$bdd->prepare("UPDATE commande SET totalcom=:totalcom,nomclient=:nomclient,tel=:tel,adresse=:adresse,tempscom=:tempscom WHERE numcom=:numcom");
        $editercomreq->bindParam(':numcom',$numcom);
        $editercomreq->bindParam(':totalcom',$totalcom);
        $editercomreq->bindParam(':nomclient',$nomclient);
        $editercomreq->bindParam(':tel',$tel);
        $editercomreq->bindParam(':adresse',$adresse);
        $editercomreq->bindParam(':tempscom',$tempscom);    
        $numcom=securiser($_GET['numcom']);
        $totalcom=securiser($_POST['totalcom']);
        $nomclient=securiser($_POST['nomclient']);
        $tel=securiser($_POST['tel']);
        $adresse=securiser($_POST['adresse']);
        $tempscom=securiser($_POST['tempscom']);
        if ($editercomreq->execute())
            {
                header('Location: gestioncommande.php');   
            } else {
                echo "Desole une erreur est survenue lors de la modification de la commande.";
            }
}
?>