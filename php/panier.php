<?php
    session_start();
    if( 1 ||isset($_SESSION["loggedin_user"]) && $_SESSION["loggedin_user"]==true && $_SESSION["username_user"]==$_SESSION["getusername_user"] && $_SESSION["id_user"]==$_SESSION["getid_user"])
    {
    require_once 'config.php'; 
    if(isset($_POST['commander'])){
        $_SESSION['id_user']=1;
        $userid=securiser($_SESSION['id_user']);
        $adresse=securiser($_POST['adresse_client']);
        date_default_timezone_set("Africa/Douala");
        $tempscom=date("Y-m-d H:i:s");
        do{
            $numcom=securiser(random_int(1,100000000));
            $dispo_numcom=$bdd->prepare('SELECT numcom FROM commande WHERE numcom=:numcom');
            $dispo_numcom->bindParam(':numcom',$numcom);
            $dispo_numcom->execute();
        }while($dispo_numcom->rowCount()>0);

        //recuperer les coordonnees du client grace a son userid

        $get_user =$bdd->prepare('SELECT * FROM users WHERE id=:userid');
        $get_user->bindParam(':userid',$userid);
        $get_user->execute();
        $user=$get_user->fetch();
        $username=$user['username'];
        $tel=$user['tel'];
        $total=$_POST['ctnTotalValueHidden'];
        //insert commande
        $insert_commande=$bdd->prepare('INSERT INTO commande (numcom,totalcom,nomclient,tel,adresse,tempscom) VALUES (:numcom,:totalcom,:nomclient,:tel,:adresse,:tempscom)');
        $insert_commande->bindParam(':numcom',$numcom);
        $insert_commande->bindParam(':totalcom',$total);
        $insert_commande->bindParam(':nomclient',$username);
        $insert_commande->bindParam(':tel',$tel);
        $insert_commande->bindParam(':adresse',$adresse);
        $insert_commande->bindParam(':tempscom',$tempscom);
        $insert_commande->execute();

            //insert prodcom
            $insert_prodcom=$bdd->prepare('INSERT INTO prodcom (numcom,image,nomprod,prixprod,qteprod,pqprod) VALUES (:numcom,:image,:nomprod,:prixprod,:qteprod,:pqprod)');
            $insert_prodcom->bindParam(':numcom',$numcom);
            $insert_prodcom->bindParam(':image',$image);
            $insert_prodcom->bindParam(':nomprod',$nomprod);
            $insert_prodcom->bindParam(':prixprod',$prixprod, PDO::PARAM_INT);
            $insert_prodcom->bindParam(':qteprod',$qteprod, PDO::PARAM_INT);
            $insert_prodcom->bindParam(':pqprod',$pqprod, PDO::PARAM_INT);

            //recuperer les info de l'utilisateur ainsi que le nombre des produits commande
            $prod_panier_req =$bdd->prepare('SELECT * FROM panier WHERE user=:userid');
            $prod_panier_req->bindParam(':userid',$userid);
            $prod_panier_req->execute();
           
            //recuperer les infos du produits commande
            $get_info_prodcom = $bdd->prepare('SELECT * FROM produits WHERE id=:prodid');
            $get_info_prodcom->bindParam(':prodid',$prodid);
            //inserer commande dans la table
            while($prod_panier=$prod_panier_req->fetch()){
                $prodid=$prod_panier['produit'];
                $get_info_prodcom->execute();
                $prodcom=$get_info_prodcom->fetch();
                $image=$prodcom['categorie'].'/'.$prodcom['image'];
                $nomprod=$prodcom['nom'];
                $prixprod=$prodcom['prix'];
                $qteprod=$prod_panier['qte'];
                $pqprod=$prixprod*$qteprod;
                $insert_prodcom->execute();
                $supp_pro_favoris =$bdd->prepare('DELETE FROM panier WHERE user=:user_id');
                $supp_pro_favoris->execute([':user_id' =>  $userid]);
                
            }
            header('Location: ../index.php');
            

    }
        
?>
<!DOCTYPE html>        
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Panier </title>
    <link rel="stylesheet" href="../style/style.css"/>
    <link rel="stylesheet" href="../style/phpFolderStyle.css"/>
    <link rel="stylesheet" href="../style/panierStyle.css"/>
    <link rel="stylesheet" href="../style/mediaQuery.css"/>
    <script src="../scripts/script.js"></script>
    <script src="../scripts/jquery-3.6.0.js"></script>
</head>
<body  onload='chargementTerminer(); caculProd();'>
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
        <header>
            <nav class="top_bar container">
                 
                <div class="icon_content">
                    <img src="../images/logo_dang.png" alt="logo dang Market"/>
                    <h3>Dang Market</h3>
                </div> 
              
                <ul class="nav_bar">
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="about.php">A propos</a></li>
                    <li><img data-list_favoris="0" src="../images/logo-user.png"/></li> 
                </ul>
                
            </nav>
        </header>
        <main class="ctn_element-ctn container">
        <div class="ctn-top-nav">
            <button class="btn-back"><a href="../index.php">&larr; Revenir au achat</a></button>
            <h1 class="t_element label-list-Panier">Votre Panier</h1>
        </div>
        <form method="post" action="" class="from_panier">
            <table class="table_panier">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Description</th>
                        <th>Prix Unitaiire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $afffiche_prod_panier=$bdd->prepare("select * from panier WHERE user=:user ORDER BY (id) DESC");
                        $afffiche_prod_panier->bindParam(':user',$user);
                        $user=1;
                        $afffiche_prod_panier->execute();
                        while($produit_panier=$afffiche_prod_panier->fetch())
                        {
                            $prod_panier_req = $bdd->prepare('SELECT * FROM produits WHERE id=:prodid');
                            $prod_panier_req->bindParam(':prodid',$prodid);
                            $prodid=$produit_panier['produit'];
                            $prod_panier_req->execute();
                            $coores_prod_panier=$prod_panier_req->fetch();
                        ?>
                            <tr>
                                <td>
                                    <div class="img_prod_panier"> 
                                        <img src="../images/image_produit/<?=$coores_prod_panier['categorie'];?>/<?=$coores_prod_panier['image'];?>" alt="image oumar T"/>
                                    </div>
                                </td>
                                <td>
                                    <p>
                                        <?=$coores_prod_panier['description'];?>
                                    </p>
                                </td>
                                <td><h1 class="prix-unitaire"><?=$coores_prod_panier['prix'];?> FCFA</h1></td>
                                <td> 
                                    <input min="1" class="qte_prod" type="number" value="<?=$produit_panier['qte'];?>" data="<?=$coores_prod_panier['id'];?>">
                                </td>
                                <td class="prix_qte" ><h1 class="prix_qte_value"><?=$coores_prod_panier['prix']*$produit_panier['qte'];?>FCFA</h1></td>
                                <td><a href="suppPanier.php?idprod=<?= $coores_prod_panier['id'];?>"><img src="../images/icones/suppprod.png"></a></td>
                                
                            </tr>  

                        <?php
                            } 
                            $afffiche_prod_panier->closeCursor();
                        ?>   
                    </tbody>
                </table>
            <div class="total">
                <div class="ctnLabelTotal">
                    <h1>Total : </h1>
                </div>
                <div class="ctnTotal">
                    <h1 class="ctnTotalValue">1000FCFA</h1>
                    <input type="hidden" name='ctnTotalValueHidden' value=""/>
                </div>
            </div>
            <button class="button-commander" name='commander'>Commander</button>
            <div class="ctn-input ctn_livraison">
                <label class="fielsetInput" for="idlivraison">addresse livraison</label>
                <input id="idlivraison" name='adresse_client' type="text" placeholder="saisir l'adresse livraison" required>
            </div>
       </form>  
      </main>
    </div>
        </body>
    </html>
    <?php 
    } else {
        header('Location: loginSignUp.php');
    } ?>
    <script>
    var fromPan=document.getElementsByClassName("from_panier")[0];
    var pan=fromPan.getElementsByClassName("table_panier")[0];
    var tbody=document.getElementsByTagName("tbody")[0];
    if(tbody.childElementCount===0){
        fromPan.style.display='none';
    }
    //mettre a jour la qte
    $(document).ready(function (){
        $('.qte_prod').change(function()
        {
            caculProd();
        });    
    });
    function caculProd(){
        var tctn = tbody.getElementsByTagName("tr");
        var totalelt = tctn.length;
        if (totalelt > 0) {
            var total = 0;
            for (var i = 0; i < totalelt; i++) {
                var prixt = parseInt(tctn[i].getElementsByClassName("prix-unitaire")[0].innerHTML);
                var qtet = tctn[i].getElementsByClassName("qte_prod")[0].value;
                tctn[i].getElementsByClassName("prix_qte_value")[0].innerHTML=qtet*prixt+' FCFA';
                if (qtet < 0) {
                    qtet = Math.round(Math.abs(qtet));
                }else{
                    if(qtet==0){
                        qtet=1;
                    }
                }
                tctn[i].getElementsByClassName("qte_prod")[0].value= qtet;
                totalt= prixt * qtet;
                total +=totalt;
            }
            document.getElementsByClassName('ctnTotalValue')[0].innerHTML = total + ' FCFA';
            document.getElementsByClassName('ctnTotalValueHidden')[0].value = total;
        }
}
</script>