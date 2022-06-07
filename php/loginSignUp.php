<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login|SignUp</title>
    <link rel="stylesheet" href="../style/style.css" />
    <link rel="stylesheet" href="../style/style_userPopUp.css" />
    <link rel="stylesheet" href="../style/phpFolderStyle.css" />
    <link rel="stylesheet" href="../style/mediaQuery.css" />
    <link rel="icon" href="" />
    <script src="../scripts/script.js"></script>
</head>

<body onload="chargementTerminer();">
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
                    <img src="../images/logo_dang.png" alt="logo dang Market">
                    <h3>Dang Market</h3>
                </div>
                <ul class="nav_bar">
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="about.php" class="active">A propos</a></li>
                    <li><img data-list_favoris="0" src="../images/logo-user.png"></li>
                </ul>
            </nav>
        </header>
        <main class="ctn_element-ctn container">
            <div class="ctnElement">
                <div class="ctnLogo">
                    <div class="ctn-logo-all">
                        <img src="../images/logo_dang.png" alt="logoDang">
                    </div>
                </div>
                <form id="idSignUpUser" class="ctnLogin" action="signup_user_post.php" method="POST" style="display: none;">
                    <h1 class="titleContainer">Inscription</h1>
                    <div class="ctn-input">
                        <label class="fielsetInput" for="username">Nom</label>
                        <input id="username" name='username_signup' type="text">
                        <div class="ctn-input">
                            <label class="fielsetInput" for="idemail">Addresse email</label>
                            <input id="idemail" name='email_signup' type="mail">

                            <div class="ctn-input">
                                <label class="fielsetInput" for="idtel">Numero</label>
                                <input id="idtel" name='tel_signup' type="tel">

                                <div class="ctn-input">
                                    <label class="fielsetInput" for="idfirstpassword">Mot de passe</label>
                                    <input type="password" name='password_signup' id="idfirstpassword">

                                    <div class="ctn-input">
                                        <label class="fielsetInput" for="idsecondpassword">Confirmation</label>
                                        <input type="password" name='second_password_signup' id="idsecondpassword">
                                        <button type="submit" name='signup_button'>S'inscrire</button>
                                        <div class="ctnLabelO">Ou</div>
                                        <input type="button" class="login-btn" onclick="revalLogin();" value="Connectez-Vous"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="idLoginUser" class="ctnLogin" action="login_user_post.php" method="POST" style="display: block;">
                    <h1 class="titleContainer">Connexion</h1>
                    <div class="ctn-input">
                        <label class="fielsetInput" for="username">Nom</label>
                        <input id="username" name='username_login' type="text">

                        <div class="ctn-input">
                            <label class="fielsetInput" for="idpassword">Mot de passe</label>
                            <input type="password" name='password_login' id="idpassword">

                            <button type="submit" name='login_button'>Se Connecter</button>
                            <div class="ctnLabelO">Ou</div>
                            <input type="button" class="createAccountBtn" onclick="revalSignUp();" value="S'inscrire">

                        </div>
                    </div>
                </form>
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
                            <li><a href="index.php">Accueil</a></li>
                            <li><a href="php/contact.php">Contact</a></li>
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
                        <p>Receivez de nouvelles informations sur notre site ou de nouveaux produits a faibles coût, en
                            vous insscrivant sur ce formulaire ci-dessous : </p>
                        <input type="email" name="email" id="idmail" placeholder="entrez votre email">
                        <button type="submit">s'abonner</button>
                    </form>
                </div>
            </div>
            <h3>Copyright 2022 L3 INFORMATIQUE</h3>
        </footer>
    </div>
</body>

</html>