<?php
    session_start();
    require_once 'config.php';
?>
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
            var id_prod=this.getAttribute('id');
            $.post('php/addPanier.php',{id_prod:id_prod});
        });
    });
</script>