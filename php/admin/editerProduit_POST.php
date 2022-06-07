<?php
session_start();
if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
    if(isset($_POST['submit'])){
        require_once '../config.php';
        //require_once 'ftp.php';
        $id=securiser($_GET['id']);
        $categorie=securiser($_POST['categorie']);
        $image=$_FILES['image']['name'];
        if($_FILES['image']['name']==NULL)
        {
            $nom=securiser($_POST['nom']);
            $prix=securiser($_POST['prix']);
            $description=securiser($_POST['description']);
            $editprod=$bdd->prepare("UPDATE produits SET categorie=:categorie,nom=:nom,prix=:prix,description=:description WHERE id=:id"); 
            $editprod->bindParam(':categorie',$categorie);
            $editprod->bindParam(':nom',$nom);
            $editprod->bindParam(':prix',$prix);
            $editprod->bindParam(':description',$description);
            $editprod->bindParam(':id',$id);     
            if ($editprod->execute())
            {
                header('Location: gestionProduit.php');   
            }

        }else{
            $target_dir ="../../images/image_produit/".$_POST['categorie']."/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "Le fichier importer n'est pas une image.";
                    $uploadOk = 0;
                    
                }
        
            /*if (file_exists($target_file)) {
                echo " L'image existe deja ";
                $uploadOk = 0;
            }*/
        
            if ($_FILES["image"]["size"] > 500000) {
                echo "L'image est trop volumineuse.";
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Seul les extensions JPG, JPEG, PNG & GIF sont accepter .";
                $uploadOk = 0;
            }
        
            if ($uploadOk == 0) {
                echo "Echec d'edition du produit";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $nom=securiser($_POST['nom']);
                    $prix=securiser($_POST['prix']);
                    $description=securiser($_POST['description']);
                    $editprod=$bdd->prepare("UPDATE produits SET categorie=:categorie,image=:image,nom=:nom,prix=:prix,description=:description WHERE id=:id");
                    $editprod->bindParam(':categorie',$categorie);
                    $editprod->bindParam(':image',$image);
                    $editprod->bindParam(':nom',$nom);
                    $editprod->bindParam(':prix',$prix);
                    $editprod->bindParam(':description',$description);
                    $editprod->bindParam(':id',$id);
                    if ($editprod->execute())
                    {
                        header('Location: gestionProduit.php');   
                    }
                } else {
                    echo "Desole une erreur est survenue lors de l'importation de l'image.";
                }
            }
        }
    }
}
?>