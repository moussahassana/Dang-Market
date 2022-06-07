<?php
    session_start();
    require_once 'config.php';
    $nbr_favoris=0;
    
        $_SESSION['id_user']=1;
        $userid=securiser($_SESSION['id_user']);
        $affiche_favoris =$bdd->prepare('SELECT * FROM user_favoris WHERE user=:userid');
        $affiche_favoris->bindParam(':userid',$userid);
        if($affiche_favoris->execute()){
            $nbr_favoris= $affiche_favoris->rowCount();
        }   
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css"/>
    <link rel="stylesheet" href="../style/mediaQuery.css"/>
    <link rel="stylesheet" href="../style/phpFolderStyle.css">
    <link rel="stylesheet" href="../style/style_userPopUp.css"/>
    <link rel="icon" href=""/>
    <script src="../scripts/script.js"></script>
    <script src="../scripts/jquery-3.6.0.js"></script>
    <title>My Favorite</title>
</head>
<body onload='chargementTerminer();'>
    <div class='banner'>
        <div class='loading-content'>
            <div class="animPoint">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1>Chargement ...</h1>
        </div>
    </div>
    <div class="globalContainer">
        <div class="ctn_user_popPup">
            <div class="user_info container">
               
            </div>
        </div>
        <header>
            <nav class="top_bar container">
                <div class="icon_content">
                    <img src="../images/logo_dang.png" alt="logo dang Market"/>
                    <h3>Dang Market</h3>
                </div>
                
                <ul class="nav_bar">
                    <li><a href="../index.php" class="active">Accueil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="about.php">A propos</a></li>
                    <li><img src="../images/logo-user.png" id="userPopUp"/></li>
                </ul>
            </nav>
        </header>
        <main class="ctn_element-ctn container">
            <h1 class="t_element">Liste Produit favoris</h1>
            <div class="list_produit_favoris">
                <?php
                    while($prod=$affiche_favoris->fetch())
                    {
                        $prod_favoris_req = $bdd->prepare('SELECT * FROM produits WHERE id=:prodid');
                        $prod_favoris_req->bindParam(':prodid',$prodid);
                        $prodid=$prod['produit'];
                        $prod_favoris_req->execute();
                        $prod_favoris=$prod_favoris_req->fetch();
                    ?>
                
                <div class="cadreProduitFav">
                   <img src="..\images\image_produit\<?= $prod_favoris['categorie']?>\<?= $prod_favoris['image']?>" alt="image produit"/>
                   <div class="nomProd">
                       <h1><?= $prod_favoris['nom']?></h1>
                   </div>
                   <div class="desProd">
                       <p>
                            <?= $prod_favoris['description']?>
                       </p>
                   </div>
                   <div class="prixProd">
                       <h1><?= $prod_favoris['prix']?>FCFA</h1>
                   </div>
                   <div class="addCart">
                       <button class="btn-action addPan">Ajouter au panier</button>
                       

                   </div>
                   <div class="bookRemove">
                       <button class="btn-action bookRem"><a href="suppFavoris_POST.php?idprod=<?= $prod_favoris['id'];?>">Supprimer du favoris</a></button>
                   </div>
                </div>
                <?php
                    }
                    $affiche_favoris->closeCursor();
                ?>
            </div>
        </main>
        <footer>
            <div class="ctn_footer container">
                <div class="logo_ctn">
                    <img src="../images/logo_dang.png" alt="">
                    <h3>Dang Market</h3>
                </div>
                <div class="navigation-content">
                    <nav class="menu">
                        <h1 class="title_nav">MENU</h1>
                        <ul>
                            <li><a href="../index.php">Accueil</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="about.php">A propos</a></li>
                        </ul>
                    </nav>
                    <nav class="menu">
                        <h1 class="title_nav">NOS RESEAUX</h1>
                        <ul>
                            <li><a href="https://www.Facebook.com" target="_blank">Facebook</a></li>
                            <li><a href="https://www.Instagram.com" target="_blank">Instagram</a></li>
                            <li><a href="https://www.twitter.com" target="_blank">twitter</a></li>
                        </ul>
                    </nav>
                    <form class="new_letter" action="php/newletter.php" method="post">
                        <h1 class="title_nav">NEWSLETTER</h1>
                        <p>Receivez de nouvelles informations sur notre site ou de nouveaux produits a faibles coût, en vous insscrivant sur ce formulaire ci-dessous : </p>
                        <input type="email" name="email" id="idmail" placeholder="entrez votre email"/>
                        <button type="submit">s'abonner</button>
                    </form>
                </div>
            </div>
            <h3>Copyright 2022 L3 INFORMATIQUE</h3>
        </footer>
    </div>
</body>
</html>
