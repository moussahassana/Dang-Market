<?php
    session_start();
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        require_once '../config.php'; 
        $affiche_commande = $bdd->query('SELECT * FROM commande ORDER BY tempscom DESC');
        if (isset($_GET['recherche']) AND !empty($_GET['recherche']))
        {
            $recherche=securiser($_GET['recherche']);
            $affiche_commande= $bdd->query('SELECT * FROM commande WHERE numcom LIKE "%'.$recherche.'%" ORDER BY tempscom DESC');
            if($affiche_commande->rowCount()==0)
            {
                $affiche_commande = $bdd->query('SELECT * FROM commande WHERE CONCAT(numcom,tel,nomclient,adresse,tempscom) LIKE "%'.$recherche.'%" ORDER BY tempscom DESC');
            }
        }
        $deletecom0=$bdd->prepare("DELETE FROM commande WHERE totalcom=:totalcom");
        $deletecom0->bindValue(':totalcom','0');
        $deletecom0->execute();
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
                <td class="tble_col">Numero</td>
                <td class="tble_col">Montant</td>
                <td class="tble_col">Nom Client</td>
                <td class="tble_col">Tel Client</td>
                <td class="tble_col">Addresse Livraison</td>
                <td class="tble_col">Date et Heure</td>
                <td class="tble_col">Statut</td>
                <td class="tble_col">Action</td>
            </thead>
            <tbody>
            <?php
                while ($commande = $affiche_commande->fetch())
                {
                ?>
                        <tr style='<?php if($commande['statut']=='Non'){echo"background:rgba(255, 0, 40, 0.835) no-repeat";}else{echo"background:rgba(92, 231, 73, 0.698) no-repeat";}?>'>
                            <td class="numcom_ajax">
                                <?= $commande['numcom'];?>
                            </td>
                            <td>
                                <?= $commande['totalcom']. " FCFA";?>
                            </td>
                            <td>
                                <?= $commande['nomclient'];?>
                            </td>
                            <td>
                                <?= $commande['tel'];?>
                            </td>
                            <td>
                                <?= $commande['adresse'];?>
                            </td>
                            <td>
                                <?= $commande['tempscom'];?>
                            </td>
                            <td onclick='upd_statut(this)' class='img_statut'>
                                    <img <?php if($commande['statut']=='Non'){echo 'src=../../images/icones/croixf.png';}else{echo 'src=../../images/icones/croixv.png';}?> alt='<?= $commande['statut']; ?>' class='img_statut' />
                            </td>
                            <td>
                                <a href="gestionProduitsCom.php?numcom=<?= $commande['numcom'];?>"><img src="../../images/icones/view_prodcom.png" with="40px" height="40px"></a>
                                <a href="editerCommande.php?numcom=<?= $commande['numcom'];?>"><img src="../../images/icones/editerprod.png"></a>
                                <a href="supprimerCommande_POST.php?numcom=<?=$commande['numcom'];?>"><img src="../../images/icones/suppprod.png"></a>
                            </td>
                        </tr>
                        <?php
                }
                ?>
            </tbody>
        </table>
        <?php
            $affiche_commande->closeCursor();
        ?>
    </main>
    <script>
        function upd_statut(e){
            var numcom_ajax=e.parentNode.getElementsByClassName('numcom_ajax')[0].innerHTML;
            var statut_ajax=e.getElementsByClassName('img_statut')[0].getAttribute('alt');
            if(statut_ajax=='Non')
            {
                e.getElementsByClassName('img_statut')[0].setAttribute('src','../../images/icones/croixv.png');
                e.getElementsByClassName('img_statut')[0].setAttribute('alt','Oui');
                e.parentNode.style.background='rgba(92, 231, 73, 0.698) no-repeat';
            }else{
                e.getElementsByClassName('img_statut')[0].setAttribute('src','../../images/icones/croixf.png');
                e.getElementsByClassName('img_statut')[0].setAttribute('alt','Non');
                e.parentNode.style.background='rgba(255, 0, 40, 0.835)  no-repeat';
            }
            var statut_upd=e.getElementsByClassName('img_statut')[0].getAttribute('alt');  
            $.post('sendstatut.php',{numcom:numcom_ajax,statut:statut_upd});
        }
    </script>

</body>
</html>
<?php 
} else {
    header('Location: index.php');
} ?>