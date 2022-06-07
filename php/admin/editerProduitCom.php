<?php
    session_start();
    // tester si l'utilisateur est deja connecter
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        if(isset($_GET['id']))
        {
            require_once '../config.php';
            $deletecom0=$bdd->prepare("DELETE FROM commande WHERE totalcom=:totalcom");
            $deletecom0->bindValue(':totalcom','0');
            $deletecom0->execute();
            $id=securiser($_GET['id']);
            $afficheprodcommodif_req=$bdd->prepare("select * from prodcom WHERE id=:id");
            $afficheprodcommodif_req->bindParam(':id',$id);
            $afficheprodcommodif_req->execute();
            $donnees=$afficheprodcommodif_req->fetch();
        }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css" />
    <link rel="stylesheet" href="../../style/admin-style.css" />
    <script src="../../scripts/jquery-3.6.0.js"></script>
    <title>Gestion Commande</title>
</head>

<body>
    <div class="header_nav">
        <div class="ctn-header container">
            <h1>Dang Market</h1>
            <nav class="nav-bar">
                <ul class="menu">
                    <li>
                        <a href="">Gestion</a>
                        <ul class="sub_menu">
                            <li><a href="gestionProduit.php">Gestion Produit</a></li>
                            <li><a  class="active" href="gestionCommande.php">Gestion Commande</a></li>
                            <li><a href="userAccount.php">Gestion Utilisateur</a></li>
                        </ul>
                    </li>
                    <li><a href="ajoutProduit.php">Ajouter Produit</a></li>
                </ul>
                <a href='logout.php'><img src="../../images/logo-user.png" alt="user_admin_logo"></a>
            </nav>
        </div>
    </div>
    <main class="ctn_element-ctn container">
                    <h2 class="title">MODIFIER LA QUANTITE D'UN PRODUIT COMMANDE</h2>
                    <form class="form-edition" action="editerProduitCom_POST.php?id=<?= $id ?>" method="POST">
                        <p>
                            <label for="numcom">N° commande:</label>
                            <input type="text" name="numcom" id="numcom" value="<?= $donnees['numcom'];?>" readonly/>
                        </p>
                        <p>
                            <label for="nomprod">Nom du produit :</label>
                            <input type="text" name="nomprod" id="nomprod" value="<?= $donnees['nomprod'];?>" readonly/>
                        </p>
                        <p>
                            <label for="prixprod">Prix du produits:</label>
                            <input type="text" name="prixprod" id="prixprod" value="<?= $donnees['prixprod'];?>" readonly/>
                        </p>
                        <p>
                            <label for="qteprod"> Quantité du produit :</label>
                            <input type="text" name="qteprod" id="qteprod" value="<?= $donnees['qteprod'];?>" />
                        </p>
                        
                        <input type="submit" name="modifierCom" value="MODIFIER">
                    </form>
                
    </main>
    </body>
</html>
<?php
    } else {
        header('Location: index.php');
    }   
?>