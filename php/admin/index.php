<?php
    session_start();
    require_once '../config.php';
    // tester si l'utilisateur est deja connecter
    if(isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"]==true && $_SESSION["username_admin"]==$_SESSION["getusername_admin"] && $_SESSION["id_admin"]==$_SESSION["getid_admin"])
    {
        header("Location: gestionCommande.php");
        exit;
    }
    $username=$password= "";
    $username_err=$password_err=$login_err= "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {   // tester si l' nom d'utilisateur est defini
        
        if(empty(securiser($_POST["username"])))
        {
            ?><script> var error="Entrer votre nom d'utilisateur";</script><?php
        }else{
            //securiser le champ nom d'utilisateur
            $username=securiser($_POST["username"]);
        }
        // tester si le mot de passe est definie
        if(empty(securiser($_POST["password"])))
        {
            $password_err="Entrer votre mot de passe s'il vous plai ";
        }else{
            $password=securiser($_POST["password"]);
        }
        if(empty($username_err) && empty($password_err))
        {
            $sql="SELECT id,username,password FROM admin WHERE username = :username";
            
            if($requete=$bdd->prepare($sql))
            {
                //parametre requete preparee
                $requete->bindParam(":username",$param_username,PDO::PARAM_STR);
                //valeur parametre
                $param_username=securiser($_POST["username"]);
                if($requete->execute())
                {
                    if($requete->rowcount()==1)
                    {
                        if($donnees=$requete->fetch())
                        {
                            $id=$donnees["id"];
                            $username=$donnees["username"];
                            $hashed_password=$donnees["password"];
                            if(password_verify($password,$hashed_password))
                            {
                                // mot de passe correct
                                // stockage des données dans les variables sessions
                                $_SESSION["loggedin_admin"]=true;
                                $_SESSION["getid_admin"]=$id;
                                $_SESSION["id_admin"]=$id;
                                $_SESSION["username_admin"]=$username;
                                $_SESSION["getusername_admin"]=$username;
                                // redirection vers acceuil admin
                                header("Location: gestionCommande.php");

                            }else{
                                // mot de passe incorrect
                                ?><script>var errorbol=false; var failure='moyen'; var error="mot de passe incorrect";</script><?php
                            }
                        }  

                    }else{
                        //le nom d'utilisateur n'existe pas
                        ?><script> var errorbol=false; var failure='grave'; var error=" le nom d'utilisateur ou mot de passe incorect";</script><?php
                        }
                    
                }else{
                    ?><script> var errorbol=false; var failure='attention'; var error="Oops ! une erreur est survenue ! veillez réessayer plus tard";</script><?php
                }
                    // fermeture requete
                    unset($requete);
            }
            }
            //déconnexion à la bdd
            unset($bdd);
        }  
    
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | ADMIN</title>
    <link rel="stylesheet" href="../../style/style.css"/>
    <link rel="stylesheet" href="../../style/phpFolderStyle.css"/>
    <link rel="stylesheet" href="../../style/admin-style.css"/>
    <script src="../../scripts/script.js"></script>
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
                    <img src="../../images/logo_dang.png" alt="logo dang Market" />
                    <h3>Dang Market</h3>
                </div>
                <ul class="nav_bar">
                    <li><a href="../../index.php">Accueil</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="../about.php" class="active" >A propos</a></li>
                    <li><img data-list_favoris="0" src="../../images/logo-user.png" /></li>
                </ul>
            </nav>
        </header>
        <main class="ctn_element-ctn container">
            <h1 class="t_element">Connectez-vous admin</h1>
            <div class="ctnElement">
                <div class="ctnLogo">
                    <div class="ctn-logo-all">
                        <img src="../../images/logo_dang.png" alt="logoDang">
                    </div>
                </div>
                <form id="idLoginUser" class="ctnLogin" action="" method="POST" style="display: block;">
                    <h1 class="titleContainer">Connexion</h1>
                    <div class="ctn-input">
                        <label class="fielsetInput" for="usernames">Nom</label>
                        <input id="usernames" name='username' type="text">
                        <div class="ctn-input">
                            <label class="fielsetInput" for="idpassword">Mot de passe</label>
                            <input type="password" name='password' id="idpassword">
                            <button type="submit" name='se_connecter'>Se Connecter</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        
    </div>
</body>
</html>
