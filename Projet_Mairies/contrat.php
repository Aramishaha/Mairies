<?php 
session_start(); // Démarre une session pour gérer les données de session comme la connexion de l'utilisateur
require('database.php'); // Inclut le fichier de connexion à la base de données
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Définit le jeu de caractères utilisé pour la page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure une compatibilité avec les appareils mobiles -->
    <title>Contrats</title> <!-- Titre de la page qui sera affiché dans l'onglet du navigateur -->
    <link rel="icon" href="image\logo_DevisseInformatique.webp" type="image/x-icon"> <!-- Définit une icône de favicon pour la page -->
    <link rel="stylesheet" href="css_index.css"> <!-- Inclut la feuille de style pour la mise en page -->
    
    <style>
        /* Styles CSS pour le tableau et la navigation */
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            background-color: #f8f9fa; /* Fond clair pour la barre de navigation */
        }

        .navbar img {
            height: 50px; /* Détermine la taille de l'image du logo */
            width: auto; /* Garder les proportions de l'image */
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
            font-size: 18px; /* Taille des liens dans la barre de navigation */
            color: #333;
        }

        td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }

        img {
            width: 100px;
            height: auto;
        }

    </style>
</head>
<body>

<!-- Barre de navigation avec des liens conditionnels selon l'état de connexion -->
<nav class="navbar">
    <ul>
        <li><a href="indexconnect.php"><img src="image/DevisseInfo.png" alt="logo" width="500" ></a></li>
        <?php 
        if (!empty($_SESSION['login.php'])) {
            echo '<li><a href="indexconnect.php">Accueil</a></li>'; // Si l'utilisateur est connecté, lien vers la page d'accueil connectée
        } else {
            echo '<li><a href="index.html">Accueil</a></li>'; // Si l'utilisateur n'est pas connecté, lien vers la page d'accueil simple
        }
        ?>
        <li><a href="utilisateur.php">Utilisateurs</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="contrat.php">Contrat</a></li>
        <?php 
        if (!empty($_SESSION['login.php'])) {
            echo '<li><a href="logoutAction.php">Déconnexion</a></li>'; // Lien de déconnexion si l'utilisateur est connecté
        } else {
            echo '<li><a href="login.php">Connexion</a></li>'; // Lien de connexion si l'utilisateur n'est pas connecté
        }
        ?>
    </ul>
</nav>

<div class="container">
    <?php 
    // Vérifie si l'utilisateur est un administrateur avant d'afficher les contrats
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        ?>
        <!-- Formulaire de recherche de contrats par mois et année -->
        <form method="GET" action="" style="text-align: center; margin-bottom: 20px;">
            <label for="month">Mois :</label>
            <select id="month" name="month">
                <option value="">-- Choisir un mois --</option>
                <?php 
                for ($i = 1; $i <= 12; $i++) {
                    $selected = (isset($_GET['month']) && $_GET['month'] == $i) ? 'selected' : '';
                    echo "<option value='$i' $selected>".date('F', mktime(0, 0, 0, $i, 10))."</option>";
                }
                ?>
            </select>

            <label for="year">Année :</label>
            <input type="number" id="year" name="year" placeholder="2024" value="<?php echo isset($_GET['year']) ? $_GET['year'] : ''; ?>" min="2000" max="<?php echo date('Y'); ?>">

            <button type="submit">Rechercher</button>
        </form>

        <div class="mairie-grid">
            <?php 
            // Connexion à la base de données et récupération des contrats
            $query = 'SELECT * FROM contrat JOIN mairies ON contrat.mairie_id = mairies.idMairie;';
            $params = [];

            // Ajout de filtres si un mois ou une année est sélectionné
            if (!empty($_GET['month']) || !empty($_GET['year'])) {
                $query .= ' WHERE 1=1';
                
                if (!empty($_GET['month'])) {
                    $query .= ' AND MONTH(date_mise_en_place) = :month';
                    $params['month'] = $_GET['month'];
                }

                if (!empty($_GET['year'])) {
                    $query .= ' AND YEAR(date_mise_en_place) = :year';
                    $params['year'] = $_GET['year'];
                }
            }

            // Préparation et exécution de la requête
            $stmt = $bdd->prepare($query);
            $stmt->execute($params);
            $contrats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Affichage des contrats récupérés
            if (!empty($contrats)) {
                foreach ($contrats as $contrat) {
                    echo "
                    <div class='mairie-card'>
                        <p><strong>".$contrat['ville']."</strong></p>
                        <p><strong>".$contrat['type_contrat']."</strong></p>
                        <p>".$contrat['montant']."  €</p>
                        <p>Date: ".$contrat['date_mise_en_place']."</p>
                    </div>";
                }
            } else {
                echo "<p style='text-align: center;'>Aucun contrat trouvé pour ce mois/année.</p>";
            }
            ?>
        </div>
        <?php
    } else {
        ?>
        <!-- Message d'erreur si l'utilisateur n'est pas administrateur -->
        <p style="text-align: center;">Vous n'êtes pas autorisé à voir les contrats.</p>
        <?php
    }
    ?>
</div>

<!-- Styles CSS pour les cartes des contrats -->
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

</body>
</html>
