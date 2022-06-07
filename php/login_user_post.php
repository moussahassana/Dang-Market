<?php
    session_start();
    require_once 'config.php';
    $username=$password= "";
    $username_err=$password_err=$login_err= "";
    header("Location: ../index.php");
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {   // tester si l' nom d'utilisateur est defini
        
        if(empty(securiser($_POST["username_login"])))
        {
            ?><script> var error="Entrer votre nom d'utilisateur";</script><?php
        }else{
            //securiser le champ nom d'utilisateur
            $username=securiser($_POST["username_login"]);
        }
        // tester si le mot de passe est definie
        if(empty(securiser($_POST["password_login"])))
        {
            $password_err="Entrer votre mot de passe s'il vous plai ";
        }else{
            $password=securiser($_POST["password_login"]);
        }
        if(empty($username_err) && empty($password_err))
        {
            $sql="SELECT id,username,password FROM users WHERE username =:username";
            
            if($user_connexion=$bdd->prepare($sql))
            {
                //parametre requete preparee
                $user_connexion->bindParam(":username",$param_username,PDO::PARAM_STR);
                //valeur parametre
                $param_username=securiser($_POST["username_login"]);
                if($user_connexion->execute())
                {
                    
                    if($user_connexion->rowcount()==1)
                    {
                        if($user_data=$user_connexion->fetch())
                        {
                            $id=$user_data["id"];
                            $username=$user_data["username"];
                            $hashed_password=$user_data["password"];
                            if(password_verify($password,$hashed_password))
                            {
                                // mot de passe correct
                                // stockage des données dans les variables sessions
                                $_SESSION["loggedin_user"]=true;
                                $_SESSION["getid_user"]=$id;
                                $_SESSION["id_user"]=$id;
                                $_SESSION["username_user"]=$username;
                                $_SESSION["getusername_user"]=$username;
                                // redirection vers acceuil admin
                                header("Location: ../index.php");

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
                    unset($user_connexion);
            }
            }
            //déconnexion à la bdd
            unset($bdd);
        }  
?>