<?php
session_start();
// détruire les variables de session
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
exit;
?>