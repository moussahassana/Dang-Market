<?php
    session_start();
    require_once 'php/config.php';
    $nbrprodpanier=0;
    if(isset($_SESSION["loggedin_user"]) && $_SESSION["loggedin_user"]==true && $_SESSION["username_user"]==$_SESSION["getusername_user"] && $_SESSION["id_user"]==$_SESSION["getid_user"])
    {
        $userid=securiser($_SESSION['id_user']);
        $prod_panier_req =$bdd->prepare('SELECT * FROM panier WHERE user=:userid');
        $prod_panier_req->bindParam(':userid',$userid);
        if($prod_panier_req->execute()){
            $nbrprodpanier= $prod_panier_req->rowCount();
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css"/>
    <link rel="stylesheet" href="style/mediaQuery.css"/>
    <link rel="stylesheet" href="style/style_userPopUp.css"/>
    <link rel="icon" href=""/>
    <script src="scripts/script.js"></script>
    <script src="scripts/jquery-3.6.0.js"></script>
    <title>Accueil</title>
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
            
                    <div class="ctn-user-logo">
    <div class="ctn_logo_element">
        <input type="file" name="file" id="idfile" accept="*/.jpg,.png,.jpeg,.gif,.bmp,.svg,.ico" onchange="preview();"/>
        <img src="images/logo-user.png" class="user_icon" alt="user logo">
        <div class="bgImg"></div>	
        <img class="ic_camera" src="images/camera.png"/>
    </div>
    <nav>
        <ul>
            <li><a data-favoris="0" href="php/Myfavoris.php">Voir mes favoris</a></li>
        </ul>
    </nav>
</div>
<form class="ctn-user-element" action="userUpdate.php" method="POST">
    <div class="ctn-input">
        <label class="fielsetInput" for="idfirstpassword">Username</label>
        <input type="text" value="user">
    </div>
    <div class="ctn-input">
        <label class="fielsetInput" for="idfirstpassword">password</label>
        <input type="text" value="user">
    </div>
    <div class="btn-action">
        <button class="save-btn" type="submit">Ok</button>
        <input type="button" class="cancel-btn" onclick="closePopup();" value="Annuler"/>
    </div>
</form>
    <?php
               
                
            ?>
            
            </div>
        </div>
        <header>
            <nav class="top_bar container">
                <div class="icon_content">
                    <img src="images/logo_dang.png" alt="logo dang Market"/>
                    <h3>Dang Market</h3>
                </div>
                
                <ul class="nav_bar">
                    <li><a href="index.php" class="active">Accueil</a></li>
                    <li><a href="php/contact.php">Contact</a></li>
                    <li><a href="php/about.php">A propos</a></li>
                    <li class='userPopUpC'><img src="images/logo-user.png" id="userPopUp"/></li>
                    <input type="hidden" name='connexion' data-="<?php if(isset($_SESSION['id_user'])) echo'1'?>";>
                </ul>
            </nav>
        </header>
        <a href="php/panier.php"><div data-count="<?= $nbrprodpanier?>" class="panier container"></div></a>
        <div class="ctn-bar-recherche">
            <input type="search" name="search" id="idsearch" placeholder="rechercher ..." onChange="chercher(this)"/>
            <button>rechercher</button>
        </div>
        <nav class="list_categorie">
            <ul class="container"> 
                <h3>Categorie : </h3>   
                <li><a class="<?php if(!isset($categorie)) echo 'active ';?>categorie_load" id=''> TOUT </a></li> 
                <?php 
                    $affiche_categorie_prod = $bdd->query('SELECT * FROM categorie_prod ');
                    
                    while($donnees_cat= $affiche_categorie_prod->fetch())
                    {
                    ?>
                    <li><a class="<?php if($categorie==$donnees_cat['id']) echo 'active ';?>categorie_load" id='<?=$donnees_cat['id'];?>'><?=$donnees_cat['nom']; ?></a></li>
                <?php
                    } 
                    $affiche_categorie_prod->closeCursor();
                ?> 
            </ul>
        </nav>
        <main class="ctn_element container">
            <div class="slide_content">
                <div class="slide">
                    <span class="title_slide">Fruit et legume fraiche</span>
                </div>
            </div>
            <h1 class="title_list_produit">Liste de produit</h1>
            <div class="list_produit">
                <?php
                        
                if (isset($_GET['categorie']) && !empty($_GET['categorie']))
                {
                    $categorie=$_GET['categorie'];
                    $categorie=securiser($categorie);
                    $affprod = $bdd->prepare('SELECT * FROM produits WHERE categorie=:categorie ORDER BY (id) DESC');
                    $affprod->bindParam(':categorie',$categorie);  
                    $affprod->execute();                          
                }else{
                    $affprod = $bdd->query('SELECT * FROM produits ORDER BY (id) DESC');
                } 
                
            ?>
            <?php
                while ($prod = $affprod->fetch())
                {  
            ?>
            <div class="cadreProduit">
                <div class="img_content">
                    <img src="images\image_produit\<?= $prod['categorie']?>\<?= $prod['image']?>" alt="imageProduit">
                    <div class="ctn-fav">
                        <button class="btn_fav" id="<?= $prod['id']?>">ajouter au favoris</button>
                    </div>
                </div>
                <h3 class="nom_prod"><?= $prod['nom']?></h3>
                <p class="description"><?= $prod['description'] ?></p>
                <h3 class="prix_prod"><?= $prod['prix'] ?> FCFA</h3>
                <div class="ctn-btn-action">
                    <button class="btn_pan" id="<?= $prod['id']?>">Ajouter</button>
                    <button class="view">Voir</button>
                </div>
            </div>
            <?php
            }
            $affprod->closeCursor();
        ?>
            </div>
        </main>
        <footer>
            <div class="ctn_footer container">
                <div class="logo_ctn">
                    <img src="images/logo_dang.png" alt="">
                    <h3>Dang Market</h3>
                </div>
                <div class="navigation-content">
                    <nav class="menu">
                        <h1 class="title_nav">MENU</h1>
                        <ul>
                            <li><a href="../index.php">Accueil</a></li>
                            <li><a href="../php/contact.php">Contact</a></li>
                            <li><a href="php/about.php">A propos</a></li>
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
    <script src="scripts/script_ctn_page.js"></script>
</body>
<script>
    $(document).ready(function (){
        $('.categorie_load').click(function()
            {
                var categorie_prod=this.getAttribute('id');
                $('.categorie_load').removeClass('active');
                this.setAttribute('class','active categorie_load');
                $('.list_produit').load('php/categorie_produit_load.php?categorie='+categorie_prod);
            });
            
        $('.btn_pan').click(function()
        {
            var num_prod_panier=0;
            var e=document.getElementsByClassName('panier')[0];
            num_prod_panier=parseInt(e.getAttribute('data-count'));
            e.setAttribute('data-count',num_prod_panier+1);
            var id_prod=this.getAttribute('id');
            $.post('php/addPanier.php',{id_prod:id_prod});
        });
        $('.btn_fav').click(function()
        {
            var id_prod=this.getAttribute('id');
            $.post('php/addFavoris.php',{id_prod:id_prod});
        });
        $('.userPopUpC').click(function()
        {
            if(connexion==0){
                window.location.href='php/loginSignUp.php';
            }
            
        });
        $('#idsearch').change(function()
        {
            var sc=this.getAttribute("value");
            
        }); 
    });
    
</script>
</html>