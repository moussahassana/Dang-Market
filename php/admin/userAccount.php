<?php
    session_start();
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        require_once '../config.php'; 
        $affiche_user = $bdd->query('SELECT * FROM users ORDER BY id DESC');
        if (isset($_GET['recherche']) AND !empty($_GET['recherche']))
        {
            $recherche=securiser($_GET['recherche']);
            $affiche_user = $bdd->query('SELECT * FROM users WHERE username LIKE "%'.$recherche.'%" ORDER BY id DESC');
            if($affiche_user->rowCount()==0)
            {
                $affiche_user = $bdd->query('SELECT * FROM users WHERE CONCAT(username,tel,localisation,date_creation) LIKE "%'.$recherche.'%" ORDER BY id DESC');
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
    <title>Gestion Utilisateur</title>
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
                            <li><a href="index.php">Gestion Produit</a></li>
                            <li><a href="gestionCommande.php">Gestion Commande</a></li>
                            <li><a class="active" href="userAccount.php">Gestion Utilisateur</a></li>
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
                <td class="tble_col">Nom</td>
                <td class="tble_col">Email</td>
                <td class="tble_col">Operation</td>
            </thead>
            <tbody>
                <?php
                    while ($user = $affiche_user->fetch())
                    {
                ?>
                <tr>
                    <td><?=$user['username']?></td>
                    <td><?=$user['email']?></td>
                    <td>
                        <a href="supprimerUser_POST.php?iduser=<?= $user['id'];?>"><img src="../../images/icones/suppprod.png" alt=""></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>
<?
} else {
            header('Location: index.php');
    }
?>