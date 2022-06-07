<?php
    session_start();
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        require_once '../config.php'; 
        $affiche_prod = $bdd->query('SELECT * FROM produits ORDER BY id DESC');
        if (isset($_GET['categorie']) AND !empty($_GET['categorie']))
        {
            $categorie=securiser($_GET['categorie']);
            if($categorie=="tout")
            {
                $affiche_prod = $bdd->query("SELECT * FROM produits ORDER BY id DESC");
            }else{
                $affiche_prod = $bdd->query("SELECT * FROM produits WHERE categorie='$categorie' ORDER BY id DESC");
            }
            
        }
        if (isset($_GET['recherche']) AND !empty($_GET['recherche']))
        {
            $recherche=securiser($_GET['recherche']);
            $affiche_prod = $bdd->query('SELECT * FROM produits WHERE categorie LIKE "%'.$recherche.'%" ORDER BY id DESC');
            if($affiche_prod->rowCount()==0)
            {
                $affiche_prod = $bdd->query('SELECT * FROM produits WHERE CONCAT(categorie, nom) LIKE "%'.$recherche.'%" ORDER BY id DESC');
            }
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
    <title>ADMIN |ACCUEIL</title>
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
                            <li><a href="#" class="active">Gestion Produit</a></li>
                            <li><a href="gestionCommande.php">Gestion Commande</a></li>
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
        <table class="tble_element">
            <thead class="tble_head">
                <td class="tble_col i_prod">Produit</td>
                <td class="tble_col n_prod">Nom</td>
                <td class="tble_col p_prod">Prix Unitaire</td>
                <td class="tble_col d_prod">Description</td>
                <td class="tble_col o_prod">Operation</td>
            </thead>
            <tbody>
                <?php
                    while ($produit = $affiche_prod->fetch())
                    {
                ?>
                <tr class="tble_element">
                    <td class="img_prod">
                        <img src="../../images/image_produit/<?=$produit['categorie'];?>/<?=$produit['image'];?>" alt="<?= $produit['nom'];?>" />
                    </td>
                    <td class="nom_prod">
                        <h1><?= $produit['nom'];?> </h1>
                    </td>
                    <td class="prix_prod">
                        <h1><?= $produit['prix'];?> FCFA</h1>
                    </td>
                    <td class="desc_prod">
                        <p><?= $produit['description'];?> </p>
                    </td>
                    <td class="Operation_prod">
                        <a href="editerProduit.php?idprod=<?= $produit['id'];?>"><img src="../../images/icones/editerprod.png" alt=""></a>
                        <a href="supprimerProduit_POST.php?idprod=<?= $produit['id'];?>"><img src="../../images/icones/suppprod.png" alt=""></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <?php
            $affiche_prod->closeCursor();
        ?>
    </main>
</body>
</html>
<?php 
}else {
    header('Location: index.php');
} 
?>