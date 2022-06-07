<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A propos</title>
    <link rel="stylesheet" href="../style/style.css" />
    <link rel="stylesheet" href="../style/phpFolderStyle.css" />
    <script src="../scripts/script.js"></script>
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
        <header>
            <nav class="top_bar container">
                <div class="icon_content">
                    <img src="../images/logo_dang.png" alt="logo dang Market" />
                    <h3>Dang Market</h3>
                </div>
                <ul class="nav_bar">
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="about.php" class="active" >A propos</a></li>
                    <li><img data-list_favoris="0" src="../images/logo-user.png" /></li>
                </ul>
            </nav>
        </header>
        <main class="ctn_element-ctn container ctn-group-contact">
            <h1 class="titlePage t_element">Nous Contactez</h1>
            <p class="t_element black">Besoin d'un service,Une recommandation,un probleme une demande spécial on reponds a tous</p>
            <div class="ctn-element-contact">
                <div class="left-map">
                    <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3453471830876!2d13.553514414775908!3d7.426980994641691!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10effd0de1a9b671%3A0x6f5f35050787f61e!2sMarch%C3%A9%20hebdomadaire%20de%20Dang!5e0!3m2!1sfr!2scm!4v1654452279146!5m2!1sfr!2scm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <form class="ctn_user_contact" action="#" method="POST">
                    <h3 class="t_element">Vos informations :</h3>
                    <input type="text" placeholder="votre nom"/>
                    <input type="email" name="email" id="idmail" placeholder="votre em@il"/>
                    <textarea name="textarray" id="idText" cols="30" rows="10" placeholder="saisir votre message"></textarea>
                    <button class="btn" type="submit">Envoyer</button>
                </form>
            </div>
        </main>
        <footer>
            <div class="ctn_footer container">
                <div class="logo_ctn">
                    <img src="../images/logo_dang.png" alt="">
                    <h3>Dang Market</h3>
                </div>
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
                    <p>Receivez de nouvelles informations sur notre site ou de nouveaux produits a faibles coût, en vous
                        insscrivant sur ce formulaire ci-dessous : </p>
                    <input type="email" name="email" id="idmail" placeholder="entrez votre email" />
                    <button type="submit">s'abonner</button>
                </form>
            </div>
            <h3>Copyright 2022 L3 INFORMATIQUE</h3>
        </footer>
    </div>
</body>
</html>