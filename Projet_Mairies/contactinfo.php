<?php 
// Démarrage de la session (commenté ici mais pourrait être activé selon les besoins)
require('securityAction.php');  // Inclusion d'un fichier pour gérer la sécurité des actions utilisateur
require('securityActionRole.php');  // Inclusion d'un fichier pour vérifier les rôles des utilisateurs
require('database.php');  // Inclusion d'un fichier pour gérer la connexion à la base de données
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Définition de l'encodage des caractères -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Pour une compatibilité mobile -->
    <title>Détails de la Mairie</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <link rel="icon" href="image\logo_DevisseInformatique.webp" type="image/x-icon"> <!-- Icône de la page -->
    <link rel="stylesheet" href="css_index.css"> <!-- Inclusion d'une feuille de style externe -->

    <style>
        /* Styles pour le tableau */
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto; /* Marges automatiques pour centrer */
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            background-color: #f8f9fa; /* Couleur de fond de la barre de navigation */
        }

        .navbar img {
            height: 50px; /* Taille de l'image dans la barre de navigation */
            width: auto;
        }

        .navbar ul {
            display: flex;
            align-items: center;
            list-style: none; /* Supprime les puces */
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin: 0 15px; /* Espacement entre les éléments du menu */
        }

        .navbar ul li a {
            text-decoration: none; /* Supprime le souligné des liens */
            font-size: 18px; /* Taille du texte des liens */
            color: #333; /* Couleur du texte */
        }

        /* Styles pour la carte de la mairie */
        .mairie-details {
            display: flex;
            justify-content: center; /* Centrer le contenu de la section des détails */
            margin-top: 20px;
        }

        .mairie-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 80%; /* Largeur de la carte */
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre pour donner de la profondeur */
            padding: 20px;
        }

        .mairie-card img {
            max-width: 80%; /* Réduction de la taille de l'image */
            height: auto;
            border-radius: 8px; /* Coins arrondis pour l'image */
            margin-bottom: 10px; /* Espacement sous l'image */
        }

        .mairie-card p {
            margin: 10px 0; /* Espacement des paragraphes */
        }

        .mairie-card button {
            margin-top: 10px;
            width: 100%; /* Largeur du bouton */
            padding: 10px;
            background-color: #007bff; /* Couleur de fond du bouton */
            color: #fff; /* Couleur du texte */
            border: none;
            border-radius: 5px;
            cursor: pointer; /* Pointeur pour indiquer que c'est cliquable */
        }

        .mairie-card button:hover {
            background-color: #0056b3; /* Changement de couleur au survol */
        }

        /* Styles du tableau */
        table {
            width: 60%; /* Largeur du tableau */
            border-collapse: collapse;
            margin: 10px auto; /* Réduit l'espace autour du tableau */
        }

        table td {
            padding: 8px; /* Réduit l'espace interne des cellules */
            font-size: 14px; /* Taille du texte dans les cellules */
        }

        table th {
            padding: 8px;
            font-size: 14px;
            background-color: #f2f2f2; /* Couleur de fond des en-têtes de colonnes */
            border-bottom: 2px solid #ddd; /* Bordure en bas des en-têtes */
        }

        table, th, td {
            border: 1px solid #ddd; /* Bordure légère */
        }
    </style>
</head>
<body>

<!-- Barre de navigation -->
<nav class="navbar">
    <ul>
        <li><a href="indexconnect.php"><img src="image/DevisseInfo.png" alt="logo" width="500"></a></li>
        <?php 
        // Vérification si l'utilisateur est connecté
        if (!empty($_SESSION['login.php'])) {
            echo '<li><a href="indexconnect.php">Accueil</a></li>';
        } else {
            echo '<li><a href="index.html">Accueil</a></li>';
        }
        ?>
        <li><a href="utilisateur.php">Utilisateurs</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="contrat.php">Contrat</a></li>
        <?php 
        // Vérification si l'utilisateur est connecté pour afficher le lien de déconnexion
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
    // Vérification si l'utilisateur est connecté
    if (!empty($_SESSION['login.php'])) {
        // Vérifier si l'ID de la mairie est passé en paramètre GET
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $idMairie = $_GET['id']; // Récupérer l'ID de la mairie depuis l'URL
            
            // Effectuer la requête pour récupérer les informations de la mairie spécifique
            $query = 'SELECT * FROM mairies WHERE idMairie = :idMairie';
            $stmt = $bdd->prepare($query);
            $stmt->bindValue(':idMairie', $idMairie, PDO::PARAM_INT);
            $stmt->execute();
            
            // Récupérer les résultats
            $mairie = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Vérifier si la mairie existe
            if ($mairie) {
                // Affichage des détails de la mairie
                echo "<div class='mairie-details'>";
                echo "
                <div class='mairie-card'>
                    <img src='".htmlspecialchars($mairie['image'], ENT_QUOTES, 'UTF-8')."' alt='".htmlspecialchars($mairie['ville'], ENT_QUOTES, 'UTF-8')."'>
                    <h2>".htmlspecialchars($mairie['raison_sociale'], ENT_QUOTES, 'UTF-8')."</h2>
                    <p><strong>Ville :</strong> ".htmlspecialchars($mairie['ville'], ENT_QUOTES, 'UTF-8')." (".htmlspecialchars($mairie['code_postal'], ENT_QUOTES, 'UTF-8').")</p>
                    <p><strong>Catégorie :</strong> ".htmlspecialchars($mairie['categorie'], ENT_QUOTES, 'UTF-8')."</p>
                    <p><strong>Email :</strong> ".htmlspecialchars($mairie['email'], ENT_QUOTES, 'UTF-8')."</p>
                    <p><strong>Adresse :</strong> ".htmlspecialchars($mairie['adresse'], ENT_QUOTES, 'UTF-8')."</p>
                    <p><strong>Code Postal :</strong> ".htmlspecialchars($mairie['code_postal'], ENT_QUOTES, 'UTF-8')."</p>
                    <p><strong>Site Web :</strong> ".htmlspecialchars($mairie['site_web'], ENT_QUOTES, 'UTF-8')."</p>
                    <p><strong>Numéro de siren :</strong> ".htmlspecialchars($mairie['siren'], ENT_QUOTES, 'UTF-8')."</p>
                    <p><strong>Population :</strong> ".htmlspecialchars($mairie['population'], ENT_QUOTES, 'UTF-8')." habitants</p>
                    <p><strong>Année de recensement :</strong> ".htmlspecialchars($mairie['annee_recensement'], ENT_QUOTES, 'UTF-8')."</p>
                    <p><strong>Maire :</strong> ".htmlspecialchars($mairie['maire'], ENT_QUOTES, 'UTF-8')."</p>
                    <br>
                    <table border='1'>
                        <tr>
                            <td>Jours</td>
                            <td>Horaires matinées</td>
                            <td>Horaires après-midi</td>
                        </tr>
                        <!-- Affichage des horaires pour chaque jour de la semaine -->
                        <tr>
                            <td>Lundi</td>
                            <td><p>".htmlspecialchars($mairie['horaireLunM'], ENT_QUOTES, 'UTF-8')."</p></td>
                            <td><p>".htmlspecialchars($mairie['horaireLunA'], ENT_QUOTES, 'UTF-8')."</p></td>
                        </tr>
                        <tr>
                            <td>Mardi</td>
                            <td><p>".htmlspecialchars($mairie['horaireMarM'], ENT_QUOTES, 'UTF-8')."</p></td>
                            <td><p>".htmlspecialchars($mairie['horaireMarA'], ENT_QUOTES, 'UTF-8')."</p></td>
                        </tr>
                        <tr>
                            <td>Mercredi</td>
                            <td><p>".htmlspecialchars($mairie['horaireMerM'], ENT_QUOTES, 'UTF-8')."</p></td>
                            <td><p>".htmlspecialchars($mairie['horaireMerA'], ENT_QUOTES, 'UTF-8')."</p></td>
                        </tr>
                        <tr>
                            <td>Jeudi</td>
                            <td><p>".htmlspecialchars($mairie['horaireJeuM'], ENT_QUOTES, 'UTF-8')."</p></td>
                            <td><p>".htmlspecialchars($mairie['horaireJeuA'], ENT_QUOTES, 'UTF-8')."</p></td>
                        </tr>
                        <tr>
                            <td>Vendredi</td>
                            <td><p>".htmlspecialchars($mairie['horaireVenM'], ENT_QUOTES, 'UTF-8')."</p></td>
                            <td><p>".htmlspecialchars($mairie['horaireVenA'], ENT_QUOTES, 'UTF-8')."</p></td>
                        </tr>
                        <tr>
                            <td>Samedi</td>
                            <td><p>".htmlspecialchars($mairie['horaireSamM'], ENT_QUOTES, 'UTF-8')."</p></td>
                            <td><p>".htmlspecialchars($mairie['horaireSamA'], ENT_QUOTES, 'UTF-8')."</p></td>
                        </tr>
                    </table>
                    <br>
                    <!-- Liens pour les actions disponibles (mettre à jour, supprimer, ajouter) -->
                    <a href='mairieUpdateInfo.php?id=".$mairie['idMairie']."'> 
                        <button>Mettre à jour les infos</button>
                    </a>
                    <a href='mairiedelete.php?id=".$mairie['idMairie']."'>
                            <button>Supprimer une mairie</button>
                    </a>
                    <a href='mairieCreateInfo.php?id=".$mairie['idMairie']."'>
                            <button>Ajouter une mairie</button>
                    </a>
                </div>";
                echo "</div>";
            } else {
                // Message d'erreur si la mairie n'est pas trouvée
                echo "<p style='text-align: center;'>Aucune mairie trouvée avec cet ID.</p>";
            }
        } else {
            // Message d'erreur si l'ID est manquant ou invalide
            echo "<p style='text-align: center;'>L'ID de la mairie est invalide ou manquant.</p>";
        }
    } else {
        // Message pour demander à l'utilisateur de se connecter
        echo "<p style='text-align: center;'>Veuillez vous connecter pour voir les informations de la mairie.</p>";
    }
    ?>
</div>

</body>
</html>
