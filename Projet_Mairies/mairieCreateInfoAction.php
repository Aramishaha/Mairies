<?php
// Inclusion de la base de données pour interagir avec la base de données
require('database.php');

// Vérification si une session existe, l'accès n'est permis que si une session est active
if (!empty($_SESSION['login.php'])) {
    // Validation du formulaire lors de la soumission
    if (isset($_POST['validate'])) {
        // Vérification si tous les champs du formulaire sont remplis
        if (!empty($_POST['categorie']) && !empty($_POST['adresse']) && !empty($_POST['code_postal'])
            && !empty($_POST['email']) && !empty($_POST['raison_sociale']) && !empty($_POST['siren']) 
            && !empty($_POST['population']) && !empty($_POST['annee_recensement']) && !empty($_POST['maire']) 
            && !empty($_POST['horaireLunM']) && !empty($_POST['horaireLunA']) 
            && !empty($_POST['horaireMarM']) && !empty($_POST['horaireMarA']) 
            && !empty($_POST['horaireMerM']) && !empty($_POST['horaireMerA']) 
            && !empty($_POST['horaireJeuM']) && !empty($_POST['horaireJeuA']) 
            && !empty($_POST['horaireVenM']) && !empty($_POST['horaireVenA']) 
            && !empty($_POST['horaireSamM']) && !empty($_POST['horaireSamA']) 
            && !empty($_POST['ville'])) {
            
            // Récupération des données soumises via le formulaire
            $mairie_categorie = $_POST['categorie'];
            $mairie_adresse = $_POST['adresse'];
            $mairie_adresse_complement = $_POST['adresse_complement'];
            $mairie_code_postal = $_POST['code_postal'];
            $mairie_ville = $_POST['ville'];
            $mairie_email = $_POST['email'];
            $mairie_site_web = $_POST['site_web'];
            $mairie_infos = $_POST['infos'];
            $mairie_raison_sociale = $_POST['raison_sociale'];
            $mairie_siren = $_POST['siren'];
            $mairie_population = $_POST['population'];
            $mairie_annee_recensement = $_POST['annee_recensement'];
            $mairie_maire = $_POST['maire'];
            $mairie_horaireLunM = $_POST['horaireLunM'];
            $mairie_horaireLunA = $_POST['horaireLunA'];
            $mairie_horaireMarM = $_POST['horaireMarM'];
            $mairie_horaireMarA = $_POST['horaireMarA'];
            $mairie_horaireMerM = $_POST['horaireMerM'];
            $mairie_horaireMerA = $_POST['horaireMerA'];
            $mairie_horaireJeuM = $_POST['horaireJeuM'];
            $mairie_horaireJeuA = $_POST['horaireJeuA'];
            $mairie_horaireVenM = $_POST['horaireVenM'];
            $mairie_horaireVenA = $_POST['horaireVenA'];
            $mairie_horaireSamM = $_POST['horaireSamM'];
            $mairie_horaireSamA = $_POST['horaireSamA'];
            $mairie_image = $_POST['image'];
            
            // Vérification si la ville existe déjà dans la base de données
            $checkIfMairiesExists = $bdd->prepare('SELECT * FROM mairies WHERE ville = ?');
            $checkIfMairiesExists->execute(array($mairie_ville));
            
            // Si aucune mairie avec ce nom de ville n'est trouvée
            if ($checkIfMairiesExists->rowCount() == 0) {
                // Insertion des données dans la base de données si la ville n'existe pas encore
                $insertMairieOnWebsite = $bdd->prepare('INSERT INTO mairies(categorie, adresse, adresse_complement, code_postal,
                ville, email, site_web, infos, raison_sociale, siren, population, annee_recensement, maire,
                horaireLunM, horaireLunA, horaireMarM, horaireMarA, horaireMerM, horaireMerA, horaireJeuM,
                horaireJeuA, horaireVenM, horaireVenA, horaireSamM, horaireSamA, image) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                
                // Exécution de la requête d'insertion avec les données récupérées
                $insertMairieOnWebsite->execute(array($mairie_categorie,
                $mairie_adresse,
                $mairie_adresse_complement,
                $mairie_code_postal,
                $mairie_ville,
                $mairie_email,
                $mairie_site_web,
                $mairie_infos,
                $mairie_raison_sociale,
                $mairie_siren,
                $mairie_population,
                $mairie_annee_recensement,
                $mairie_maire,
                $mairie_horaireLunM,
                $mairie_horaireLunA,
                $mairie_horaireMarM,
                $mairie_horaireMarA,
                $mairie_horaireMerM,
                $mairie_horaireMerA,
                $mairie_horaireJeuM,
                $mairie_horaireJeuA,
                $mairie_horaireVenM,
                $mairie_horaireVenA,
                $mairie_horaireSamM,
                $mairie_horaireSamA,
                $mairie_image));
                
                // Rediriger l'utilisateur vers la page d'accueil après l'ajout
                header('Location: indexconnect.php');
            } else {
                // Message d'erreur si la ville existe déjà
                $errorMsg = "La mairie de cette ville existe déjà sur le site";
            }
        } else {
            // Message d'erreur si certains champs du formulaire sont laissés vides
            $errorMsg = "Veuillez compléter tous les champs...";
        }
    }
}
// Validation du formulaire
?>

