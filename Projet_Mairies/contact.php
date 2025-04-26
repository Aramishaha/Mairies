<?php 
session_start(); // Démarre la session PHP
require('database.php'); // Inclut le fichier de connexion à la base de données
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Définit le jeu de caractères pour le document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure que la page est bien responsive sur les appareils mobiles -->
    <title>Contact</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <link rel="icon" href="image\logo_DevisseInformatique.webp" type="image/x-icon"> <!-- Définit l'icône (favicon) de la page -->
    <link rel="stylesheet" href="css_index.css"> <!-- Inclut la feuille de style externe -->

    <style>
        /* Style pour les tables */
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        
        /* Style de la barre de navigation */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            background-color: #f8f9fa; /* Couleur de fond */
        }

        /* Style des images dans la barre de navigation */
        .navbar img {
            height: 50px; /* Taille des images de la navbar */
            width: auto;  /* Garde les proportions de l'image */
        }

        /* Style pour les éléments de la liste de navigation */
        .navbar ul {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin: 0 15px; /* Espacement entre les éléments de la barre de navigation */
        }

        .navbar ul li a {
            text-decoration: none; /* Enlève la sous-ligne des liens */
            font-size: 18px; /* Taille des liens */
            color: #333; /* Couleur du texte */
        }

        /* Style des cellules de la table */
        td {
            border: 1px solid #999; /* Bordure des cellules */
            padding: 10px;
            text-align: center;
        }

        /* Style des images */
        img {
            width: 100px; /* Largeur de l'image */
            height: auto; /* Hauteur automatique pour garder les proportions */
        }

    </style>
</head>
<body>

<!-- Barre de navigation -->
<nav class="navbar">
    <ul>
        <!-- Logo cliquable qui redirige vers la page d'accueil -->
        <li><a href="indexconnect.php"><img src="image/DevisseInfo.png" alt="logo" width="500" ></a></li>

        <!-- Condition PHP pour afficher l'option Accueil selon l'état de la session -->
        <?php 
        if (!empty($_SESSION['login.php'])) {
            echo '<li><a href="indexconnect.php">Accueil</a></li>';
        } else {
            echo '<li><a href="index.html">Accueil</a></li>';
        }
        ?>

        <!-- Liens de navigation -->
        <li><a href="utilisateur.php">Utilisateurs</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="contrat.php">Contrat</a></li>

        <!-- Liens de déconnexion ou connexion selon l'état de la session -->
        <?php 
        if (!empty($_SESSION['login.php'])) {
            echo '<li><a href="logoutAction.php">Déconnexion</a></li>';
        } else {
            echo '<li><a href="login.php">Connexion</a></li>';
        }
        ?>
    </ul>
</nav>

<div class="container">
    <?php 
    // Vérifie si l'utilisateur est connecté pour afficher les mairies
    if (!empty($_SESSION['login.php'])) {
        ?>
        <div class="mairie-grid">
            <?php 
            // Requête SQL pour obtenir toutes les mairies
            $query = 'SELECT * FROM mairies'; 
            $mairies = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC); 

            // Affichage des mairies en fonction du rôle de l'utilisateur (admin ou autre)
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                foreach ($mairies as $mairie) {
                    echo "
                    <div class='mairie-card'>
                        <img src='".$mairie['image']."' alt='".$mairie['ville']."'>
                        <p><strong>".$mairie['raison_sociale']."</strong></p>
                        <p>".$mairie['ville']." (".$mairie['code_postal'].")</p>
                        <p>Catégorie: ".$mairie['categorie']."</p>
                        <a href='contactinfo.php?id=".$mairie['idMairie']."'>
                            <button>Consulter les infos de la mairie</button>
                        </a>
                    </div>";
                }
            } else {
                // Affichage des mairies pour les autres utilisateurs
                foreach ($mairies as $mairie) {
                    echo "
                    <div class='mairie-card'>
                        <img src='".$mairie['image']."' alt='".$mairie['ville']."'>
                        <p><strong>".$mairie['raison_sociale']."</strong></p>
                        <p>".$mairie['ville']." (".$mairie['code_postal'].")</p>
                        <p>Catégorie: ".$mairie['categorie']."</p>
                    </div>";
                }
            }
            ?>
        </div>
        <?php
    } else {
        ?>
        <p style="text-align: center;">Veuillez vous connecter pour voir les mairies.</p>
        <?php
    }
    ?>
</div>

<!-- Style pour la grille et les cartes de mairie -->
<style>
    .mairie-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 20px;
    }

    .mairie-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        width: 250px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px;
    }

    .mairie-card img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .mairie-card p {
        margin: 10px 0;
    }

    .mairie-card button {
        margin-top: 10px;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .mairie-card button:hover {
        background-color: #0056b3;
    }
</style>

</div>
</body>
</html>
