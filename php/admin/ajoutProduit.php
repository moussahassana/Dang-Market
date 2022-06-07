<?php
    session_start();
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
            require_once '../config.php';
            if(isset($_POST["submit"])) {
                //require_once 'ftp.php';
                $categorie=securiser($_POST['categorie']);
                $image=$_FILES['image']['name'];
                $target_dir ="../../images/image_produit/".$_POST['categorie']."/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $check =getimagesize($_FILES["image"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "Le fichier importer n'est pas une image.";
                        $uploadOk = 0;
                    }
            
            /*f (file_exists($target_file)) {
                echo " L'image existe deja ";
                $uploadOk = 0;
            }*/
           
            if ($_FILES["image"]["size"] > 500000) {
                echo "L'image est trop volumineuse.";
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Seul les extensions JPG, JPEG, PNG & GIF sont acceptees .";
                $uploadOk = 0;
            }
           
            if ($uploadOk == 0) {
                echo "Echec d'enregistrement du produit";
            
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $nom=securiser($_POST['nom']);
                    $prix=securiser($_POST['prix']);
                    $description=securiser($_POST['description']);
                    $add_prod=$bdd->prepare("INSERT INTO produits (categorie,image,nom,prix,description) VALUES(:categorie,:image,:nom,:prix,:description)");
                    $add_prod->bindParam(':categorie',$categorie);
                    $add_prod->bindParam(':image',$image);
                    $add_prod->bindParam(':nom',$nom);
                    $add_prod->bindParam(':prix',$prix);
                    $add_prod->bindParam(':description',$description);
                    if($add_prod->execute())
                    {
                        //header('Location: gestionProduit.php');   
                    }
                } else {
                    echo "Desole une erreur est survenue lors de l'importation de l'image.";
                }
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
    <link rel="stylesheet" href="../../style/admin-style.css"/>
    <script src="../../scripts/script.js"></script>
    <title>AJOUT PRODUIT</title>
</head>
<body>
    <style>
        .img_select{
            display: none;
        }
        .file_input:hover .img_select{
            display: block;
        }
    </style>
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
        <h1 class="t_element">Enregistrer Votre Produit</h1>
        <form class="form-edition" action="" method="POST" enctype="multipart/form-data">
            <div class="file_input">
                <input type="file" name="image" id="images" accept="*/.jpg,.png,.jpeg,.gif,.bmp,.svg,.ico" onchange="preview();"/>
                <img id="id_img_ajout" class="img_ajout" src="../../images/icones/ajout_produit.png"/>
                <img id="target_import" src=""/>
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
                        <option value="<?=$categorie['id']?>" <?php if($categorie['id']==4) echo'selected';?>><?=$categorie['nom']?></option>
                        <?php
                            } 
                            $affiche_categorie_prod->closeCursor();
                        ?> 
                        
                    </select>
                </p>
                <p>
                    <label for="nom-prod" class="blue-color">Nom du produit :</label><br />
                    <input type="text" name="nom" id="nom-prod" class="blue-color-input"/>
                </p>
                <p>
                    <label for="prix-prod" class="blue-color">Prix du produit :</label><br />
                    <input type="text" name="prix" id="prix-prod" class="blue-color-input"/>
                </p>
                <p>
                    <label for="description-prod" class="blue-color">Description du produit :</label><br />
                    <textarea name="description" id="description-prod"  class="blue-color-input" rows="30" cols="10"> </textarea>
                </p>
                <input type="submit" name="submit" value="AJOUTER">
            </div>
        </form>
    </main>
</body>
</html>
<?php
} else {
    header('Location: index.php');
}
?>