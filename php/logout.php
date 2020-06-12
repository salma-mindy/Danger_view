<?php
    // Initialisation de la section
    session_start();
    // Annulation de toutes les variables de session
    $_SESSION = array();
 
    // Destruction de la section
    session_destroy();
 
    // Redirection vers la page de connexion
    header("location: ../index.php");
    exit;
?>