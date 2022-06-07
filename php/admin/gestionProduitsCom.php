<?php
    session_start();
    // tester si l'utilisateur est deja connecter
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        require_once '../config.php'; 
        $deletecom0=$bdd->prepare("DELETE FROM prodcom WHERE qteprod=:qteprod");
        $deletecom0->bindValue(':qteprod','0');
        $deletecom0->execute();
        $numcom=securiser($_GET['numcom']);
        $affprodcom_req = $bdd->prepare("SELECT * FROM prodcom WHERE numcom=:numcom");
        $affprodcom_req->bindParam(':numcom',$numcom);
        $affprodcom_req->execute();
       
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
                    <table class="tble_element">
                        <thead class="tble_head">
                            <td class="tble_col">NUMERO COMMANDE</td>
                            <td class="tble_col">IMAGE</td>
                            <td class="tble_col">NOM</td>
                            <td class="tble_col">PRIX</td>
                            <td class="tble_col">QUANTITE</td>
                            <td class="tble_col">TOTAL</td>
                            <td class="tble_col">ACTIONS</td>
                        </thead>
                        <?php
                        while ($affprodcom=$affprodcom_req->fetch())
                        {
                        ?>
                            <tr>
                                <td>
                                    <?= $affprodcom['numcom'];?>
                                </td>
                                <td>
                                    <img src="../../images/image_produit/<?= $affprodcom['image'];?>"/>
                                </td>
                                <td>
                                    <?= $affprodcom['nomprod'];?>
                                </td>
                                <td>
                                    <?= $affprodcom['prixprod'].' FCFA';?>
                                </td>
                                <td>
                                    <?= $affprodcom['qteprod'];?>
                                </td>
                                <td>
                                    <?= $affprodcom['prixprod']*$affprodcom['qteprod'].' FCFA';?>
                                </td>
                                <td>
                                    <a href="editerProduitCom.php?numcom=<?= $affprodcom['numcom'];?>&id=<?= $affprodcom['id'];?>"><img src="../../images/icones/editerprod.png"></a>
                                    <a href="supprimerProduitCom_POST.php?numcom=<?= $affprodcom['numcom'];?>&id=<?= $affprodcom['id'];?>"><img src="../../images/icones/suppprod.png"></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    </main>
                <?php
                $affprodcom_req->closeCursor();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
} else {
    header('Location: index.php');
} ?>