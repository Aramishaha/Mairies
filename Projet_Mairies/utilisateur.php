<?php 
// Démarre la session pour pouvoir accéder aux variables de session
session_start();

// Inclut le fichier de connexion à la base de données pour exécuter des requêtes
require('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
    <!-- Définit l'icône de la page -->
    <link rel="icon" href="image\logo_DevisseInformatique.webp" type="image/x-icon">
    <!-- Lien vers la feuille de style CSS -->
    <link rel="stylesheet" href="css_index.css">

    <style>
        /* Définition du style pour le tableau des utilisateurs */
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
            background-color: #f8f9fa; /* Couleur de fond claire */
        }

        .navbar img {
            height: 50px; /* Ajuste la taille de l'image du logo */
            width: auto;  /* Conserve les proportions de l'image */
        }

        /* Liste des éléments de la barre de navigation */
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
            font-size: 18px; /* Taille des liens */
            color: #333;
        }

        /* Style des cellules du tableau */
        td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }

        /* Style des images des utilisateurs dans le tableau */
        img {
            width: 100px;
            height: auto;
        }

    </style>
</head>
<body>

<!-- Début de la barre de navigation -->
<nav class="navbar">
    <ul>
        <!-- Logo cliquable renvoyant vers la page d'accueil -->
        <li><a href="indexconnect.php"><img src="image/DevisseInfo.png" alt="logo" width="500" ></a></li>
        
        <?php 
        // Vérification si l'utilisateur est connecté en vérifiant la session
        if (!empty($_SESSION['login.php'])) {
            echo '<li><a href="indexconnect.php">Accueil</a></li>'; // Si connecté, lien vers l'accueil connecté
        } else {
            echo '<li><a href="index.html">Accueil</a></li>'; // Sinon, lien vers la page d'accueil générale
        }
        ?>
        
        <!-- Liens vers différentes pages -->
        <li><a href="utilisateur.php">Utilisateurs</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="contrat.php">Contrat</a></li>
       
        <?php 
        // Affichage du lien de déconnexion si l'utilisateur est connecté, sinon affichage du lien de connexion
        if (!empty($_SESSION['login.php'])) {
            echo '<li><a href="logoutAction.php">Déconnexion</a></li>';
        } else {
            echo '<li><a href="login.php">Connexion</a></li>';
        }
        ?>
    </ul>
</nav>

<!-- Contenu principal de la page -->
<div class="container">
    <?php 
    // Vérifie si l'utilisateur est connecté
    if (!empty($_SESSION['login.php'])) {
        ?>
        <table>
            <tr>
                <?php 
                // Requête pour récupérer tous les utilisateurs dans la base de données
                $query = 'SELECT * FROM utilisateur'; 
                $utilisateurs = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC); 

                // Vérifie si l'utilisateur est un administrateur
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    // Si administrateur, permet de voir tous les utilisateurs avec des options pour les gérer
                    foreach ($utilisateurs as $utilisateur) {
                        echo "
                        <td>
                            <img src='".$utilisateur['image']."' alt='".$utilisateur['pseudo']."'>
                            <p>".$utilisateur['pseudo']."</p>
                            <a href='utilisateurmdp.php?id=".$utilisateur['idUser']."'>
                                <button>Mettre à jour le mot de passe</button>
                            </a>
                            <a href='utilisateurdelete.php?id=".$utilisateur['idUser']."'>
                                <button>Supprimer l'utilisateur</button>
                            </a>
                        </td>";
                    }
                } else {
                    // Si non administrateur, affiche uniquement les utilisateurs sans options de gestion
                    foreach ($utilisateurs as $utilisateur) {
                        echo "
                        <td>
                            <img src='".$utilisateur['image']."' alt='".$utilisateur['pseudo']."'>
                            <p>".$utilisateur['pseudo']."</p>
                        </td>";
                    }
                }
                ?>
            </tr>
        </table>
        <?php
    } else {
        // Si l'utilisateur n'est pas connecté, affiche un message d'avertissement
        ?>
        <p style="text-align: center;">Veuillez vous connecter pour voir les utilisateurs.</p>
        <?php
    }
    ?>
</div>
</body>
</html>
