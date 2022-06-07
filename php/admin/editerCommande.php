<?php
    session_start();
    // tester si l'utilisateur est deja connecter
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        if(isset($_GET['numcom']))
        {
            require_once '../config.php';
            $numcom=securiser($_GET['numcom']);
            $reponse=$bdd->prepare("select * from commande WHERE numcom='$numcom'");
            $reponse->execute();
            $donnees=$reponse->fetch();
        }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href="../../css/admin-style.css">
        <link rel='stylesheet' href="../../css/style_editer.css">
        <title>ADMIN |EDITER COMMANDE</title>
      
    </head>
    <body>
        <div class="container">
            <div class="admin_container">
                <aside class="aside_container">
                    <div class="logo_aside">
                        <img src="../../ressources/icones/ep-blanc.png" alt="logo" />
                    </div>
                    <div class="myadmin">My admin</div>
                    <ul>
                        <li><a href="gestionProduits.php" class="active"> Gestion Produits</a></li>
                        <li><a href="gestioncommande.php"> Gestion Commandes</a></li>
                        <li><a href="gestionSlider.php"> Gestion Slider</a></li>
                        <li><a href="statistiques.php"> Statistiques</a></li>
                        <li><a href="logout.php"> Deconnexion</a></li>
                    </ul>
                </aside>
                <div class="admin_operation deca">
                    <h2 class="title">MODIFIER LES INFORMATIONS D'UNE COMMANDE</h2>
                    <form class="form-edition" action="editerCommande_POST.php?numcom=<?= $numcom ?>" method="POST">
                        <p>
                            <label class='label_editer_com' for="numcom">N° commande :</label>
                            <input type="text" name="numcom" id="numcom" value="<?= $donnees['numcom'];?>" readonly />
                        </p>
                        <p>
                            <label class='label_editer_com' for="totalcom">Montant:</label>
                            <input type="text" name="totalcom" id="totalcom" value="<?= $donnees['totalcom'];?>" readonly />
                        </p>
                        <p>
                            <label class='label_editer_com' for="nomclient">Nom du client :</label>
                            <input type="text" name="nomclient" id="nomclient" value="<?= $donnees['nomclient'];?>"/>
                        </p>
                        <p>
                            <label class='label_editer_com' for="tel">Numero du client :</label>
                            <input type="text" name="tel" id="tel" value="<?= $donnees['tel'];?>"/>
                        </p>
                        <p>
                            <label class='label_editer_com' for="adresse"> Adresse :</label>
                            <input type="text" name="adresse" id="adresse" value="<?= $donnees['adresse'];?>"/>
                        </p>
                        <p>
                            <label class='label_editer_com' for="tempscom">TEMPS :</label>
                            <input type="text" name="tempscom" id="tempscom" value="<?= $donnees['tempscom'];?> "readonly/>
                        </p>
                            <input type="submit" name="modifierCom" value="MODIFIER">
                    </form>
                </div>
    </body>
</html>
<?php
    } else {
        header('Location: index.php');
    }   
?>