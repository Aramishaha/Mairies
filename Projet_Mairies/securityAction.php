<?php
// Démarre une session PHP afin de gérer les variables de session
session_start();

// Vérifie si la session 'auth' n'est pas définie, ce qui signifie que l'utilisateur n'est pas authentifié
if(!isset($_SESSION['auth'])){
    // Si la session 'auth' n'est pas définie, redirige l'utilisateur vers la page d'accueil (index.html)
    header('Location: index.html');
}
?>
