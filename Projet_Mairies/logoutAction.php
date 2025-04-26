<?php
session_start(); // Démarre la session PHP, permettant d'accéder aux variables de session existantes (si elles existent).

$_SESSION = []; // Vide toutes les variables de session, en les réinitialisant à un tableau vide.

session_destroy(); // Détruit la session PHP, ce qui met fin à la session actuelle et supprime les données stockées côté serveur.

header('Location: index.html'); // Redirige l'utilisateur vers la page 'index.html' après la destruction de la session.
?>
