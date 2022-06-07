<?php
    session_start();
    // tester si l'utilisateur est deja connecter
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {  
        require_once '../config.php';
        if(isset($_GET['idprod']))
        {
            $id=securiser($_GET['idprod']);
            $afffiche_prod_editer=$bdd->prepare("select * from produits WHERE id=:id");
            $afffiche_prod_editer->bindParam(':id',$id);
            $afffiche_prod_editer->execute();
            $produit=$afffiche_prod_editer->fetch();
        }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css" />
    <link rel="stylesheet" href="../../style/admin-style.css"/>
    <script src="../../scripts/script.js"></script>
    <title>METTRE A JOUR UN PRODUIT</title>
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
        <h1 class="t_element">Mise à jour du Produit</h1>
        <form class="form-edition" action="editerProduit_POST.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            <div class="file_input">
                <input type="file" name="image" id="images" accept="*/.jpg,.png,.jpeg,.gif,.bmp,.svg,.ico" onchange="preview();"/>
                <img class="img_ajout" src="../../images/icones/ajout_produit.png"/>
                <img id="target_import" src="../../images/image_produit/<?= $produit['categorie'];?>/<?= $produit['image'];?>" alt="<?= $produit['nom'];?>"/>
            </div>
            <div class="info-import">
                <label>Selectionner la categorie de produit : </label>
                <p>
                    <select name="categorie" id="catSelect">
                        <?php 
                            $affiche_categorie_prod = $bdd->query('SELECT * FROM categorie_prod');
                            while($categorie= $affiche_categorie_prod->fetch())
                            {
                        ?>
                        <option value="<?=$categorie['id']?>" <?php if($produit['categorie']==$categorie['id']) echo'selected';?> ><?=$categorie['nom']?></option>
                       
                        <?php
                            } 
                            $affiche_categorie_prod->closeCursor();
                        ?> 
                        
                    </select>
                </p>
                <p>
                    <label for="nom-prod" class="blue-color">Nom du produit :</label><br />
                    <input type="text" name="nom" id="nom-prod" class="blue-color-input" value="<?= $produit['nom'];?>"/>
                </p>
                <p>
                    <label for="prix-prod" class="blue-color">Prix du produit :</label><br />
                    <input type="text" name="prix" id="prix-prod" class="blue-color-input" value="<?= $produit['prix'];?>"/>
                </p>
                <p>
                    <label for="description-prod" class="blue-color">Description du produit :</label><br />
                    <textarea name="description" id="description-prod"  class="blue-color-input" rows="30" cols="10"><?= $produit['description'];?></textarea>
                </p>
                <input type="submit" name="submit" value="MODIFIER">
            </div>
        </form>
    </main>
</body>
</html>
<?php
} else {
    header('Location: index.php');
} ?>