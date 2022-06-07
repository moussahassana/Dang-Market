<?php
    session_start();
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        require_once '../config.php';
        $id=securiser($_GET['id']);
        $numcom=securiser($_GET['numcom']);
        $supp_prodcom_req =$bdd->prepare('DELETE FROM prodcom WHERE id=:id');
        $supp_prodcom_req->bindParam(':id',$id);
        if ($supp_prodcom_req->execute())
        {
            $totalcom_req=$bdd->prepare("SELECT SUM(pqprod) FROM prodcom WHERE numcom=:numcom");
            $totalcom_req->bindParam(':numcom',$numcom);
            if($totalcom_req->execute())
            {
                $totalcom_fetch=$totalcom_req->fetch();
                $totalcom=$totalcom_fetch['SUM(pqprod)'];
                $update_totalcom_req=$bdd->prepare("UPDATE commande SET totalcom=:totalcom WHERE numcom=:numcom");
                $update_totalcom_req->bindParam(':totalcom',$totalcom);
                $update_totalcom_req->bindParam(':numcom',$numcom);
                if($update_totalcom_req->execute())
                {
                    $deletecom0=$bdd->prepare("DELETE FROM commande WHERE totalcom=:totalcom");
                    $deletecom0->bindValue(':totalcom','0');
                    $deletecom0->execute(); 
                    header('Location: gestionProduitsCom.php?numcom='.$numcom);
                }
            }
        }
    } else {
            header('Location: index.php');
    }
?>


        
      
