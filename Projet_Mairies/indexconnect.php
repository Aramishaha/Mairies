<?php 
//session_start(); // La fonction session_start() est commentée ici, ce qui signifie que la gestion des sessions est désactivée pour cette page. Cela peut empêcher l'accès aux variables de session pour la gestion des utilisateurs.
require('securityAction.php'); // Inclut un fichier externe 'securityAction.php' qui contient probablement des vérifications ou actions liées à la sécurité.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Définit le jeu de caractères utilisé pour la page HTML -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Assure que la page fonctionne bien sur Internet Explorer et autres navigateurs modernes -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure la compatibilité mobile et l'ajustement des tailles -->
    <title>Projet Mairie</title> <!-- Titre de la page qui sera affiché dans l'onglet du navigateur -->
    <link rel="icon" href="image\logo_DevisseInformatique.webp" type="image/x-icon"> <!-- Icône du site affichée sur l'onglet du navigateur -->
    <link rel="stylesheet" href="css_index.css" > <!-- Inclut une feuille de style externe 'css_index.css' pour la mise en page -->

    <style>
        /* Début des styles CSS pour la mise en page */
        table {
            width: 80%; /* Définit la largeur du tableau à 80% de la page */
            border-collapse: collapse; /* Fusionne les bordures des cellules du tableau */
            margin: 20px auto; /* Centre le tableau sur la page avec un espacement de 20px autour */
        }

        .navbar {
            display: flex; /* Utilise le modèle Flexbox pour la barre de navigation */
            align-items: center; /* Aligne verticalement les éléments au centre */
            justify-content: space-between; /* Distribue les éléments horizontalement avec un espace égal entre eux */
            padding: 0 20px; /* Ajoute un espacement interne de 20px à gauche et à droite */
            background-color: #f8f9fa; /* Couleur de fond de la barre de navigation (gris clair) */
        }

        .navbar img {
            height: 50px; /* Définit la hauteur de l'image à 50px */
            width: auto; /* Maintient les proportions de l'image */
        }

        .navbar ul {
            display: flex; /* Utilise Flexbox pour la liste des liens de la navigation */
            align-items: center; /* Aligne verticalement les éléments de la liste */
            list-style: none; /* Retire les puces des éléments de la liste */
            margin: 0; /* Annule la marge par défaut */
            padding: 0; /* Annule le padding par défaut */
        }

        .navbar ul li {
            margin: 0 15px; /* Ajoute une marge de 15px à gauche et à droite des éléments de la liste */
        }

        .navbar ul li a {
            text-decoration: none; /* Enlève la décoration des liens */
            font-size: 18px; /* Définit la taille du texte des liens à 18px */
            color: #333; /* Couleur du texte des liens (gris foncé) */
        }

        td {
            border: 1px solid #999; /* Bordure des cellules du tableau */
            padding: 10px; /* Ajoute un espacement de 10px dans chaque cellule */
            text-align: center; /* Centre le texte dans les cellules */
        }

        img {
            width: 100px; /* Définit la largeur des images à 100px */
            height: auto; /* Maintient les proportions des images */
        }

        /* Une seconde déclaration redondante de la barre de navigation est présente ci-dessous */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            background-color: #f8f9fa;
        }

        .navbar img {
            height: 50px;
            width: auto;
        }

        .navbar ul {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar ul li a {
            text-decoration: none;
            font-size: 18px;
            color: #333;
        }

    </style> <!-- Fin des styles CSS -->
</head>
<body>

    <!-- Barre de navigation de la page -->
    <nav class="navbar">
        <ul>
            <li><a href="indexconnect.php"><img src="image/DevisseInfo.png" alt="logo" width="500" ></a></li> <!-- Logo du site avec lien vers la page d'accueil -->
            <li><a href="indexconnect.php">Accueil</a></li> <!-- Lien vers la page d'accueil -->
            <?php 
            if (!empty($_SESSION['login.php'])) { // Vérifie si la session est active (si l'utilisateur est connecté)
                ?>
                <li><a href="utilisateur.php"> Utilisateurs </a></li> <!-- Lien vers la page des utilisateurs si connecté -->
                <?php
            } else {
                echo '<li><a href="login.php"> Connexion </a></li>'; // Si non connecté, lien vers la page de connexion
                print_r($_SESSION); // Affiche le contenu de la session pour le débogage (utile pour le développeur)
            }
            ?>
            <li><a href="contact.php"> Contact </a></li> <!-- Lien vers la page de contact -->
            <li><a href="contrat.php">Contrat</a></li> <!-- Lien vers la page des contrats -->
            <?php 
            if (!empty($_SESSION['login.php'])) { // Vérifie si la session est active (si l'utilisateur est connecté)
                ?>
                <li><a href="logoutAction.php">Déconnexion</a></li> <!-- Lien vers la page de déconnexion si connecté -->
                <?php
            } else {
                echo '<li><a href="login.php"> Connexion </a></li>'; // Si non connecté, lien vers la page de connexion
                print_r($_SESSION); // Affiche le contenu de la session pour le débogage (utile pour le développeur)
            }
            ?>
        </ul>
    </nav>

    <div class="container">
        <main>
            <section>
                <h1>Découvrez l'application Projet Mairies</h1>
                <p>Gérer vos contrats, vos utilisateurs et vos contacts comme bon vous semble.</p> <!-- Description de l'application -->
            </section>

            <section>
                <h2>Nos Objectifs</h2>
                <p>Fournir des solutions adaptées aux entrepreneurs pour pouvoir répondre aux besoins et gérer leur relations avec leurs clients de manière efficace, facile et agile.</p> <!-- Objectifs de l'application -->
            </section>
        </main>
    </div>

</body>
</html>
