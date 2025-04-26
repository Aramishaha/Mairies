<?php
require('database.php');
 

// Validation du formulaire

if (isset($_POST['validate'])) {
    // Vérifier si tous les champs requis sont complétés
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
        // Récupération des données
        $mairie_id = $_POST['idMairie'];
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


        // Vérifier si la ville existe
        $checkIfMairiesExists = $bdd->prepare('SELECT * FROM mairies WHERE idMairie = ?');
        $checkIfMairiesExists->execute(array( $mairie_id));

        // Vérifier si l'idMairie correspond à celui de la ville 

        $checkIfidMairiesMatchVille = $bdd->prepare('SELECT idMairie FROM mairies WHERE idMairie = ?');
        $checkIfidMairiesMatchVille->execute(array( $mairie_id));

        //if ($checkIfidMairiesMatchVille == $_mairie['idMairie']) {
            if ($checkIfMairiesExists->rowCount() > 0) {
                // Mise à jour
                $updateMairies = $bdd->prepare('UPDATE mairies 
                    SET categorie = ?, adresse = ?, adresse_complement = ?, code_postal = ?, email = ?, 
                        site_web = ?, infos = ?, raison_sociale = ?, siren = ?, population = ?, 
                        annee_recensement = ?, maire = ?, horaireLunM = ?, horaireLunA = ?, horaireMarM = ?, 
                        horaireMarA = ?, horaireMerM = ?, horaireMerA = ?, horaireJeuM = ?, horaireJeuA = ?, 
                        horaireVenM = ?, horaireVenA = ?, horaireSamM = ?, horaireSamA = ?, image = ? 
                    WHERE ville = ?');
                $updateMairies->execute(array(
                    $mairie_categorie, $mairie_adresse, $mairie_adresse_complement, $mairie_code_postal, $mairie_email,
                    $mairie_site_web, $mairie_infos, $mairie_raison_sociale, $mairie_siren, $mairie_population, $mairie_annee_recensement,
                    $mairie_maire, $mairie_horaireLunM, $mairie_horaireLunA, $mairie_horaireMarM, $mairie_horaireMarA, $mairie_horaireMerM,
                    $mairie_horaireMerA, $mairie_horaireJeuM, $mairie_horaireJeuA, $mairie_horaireVenM, $mairie_horaireVenA,
                    $mairie_horaireSamM, $mairie_horaireSamA, $mairie_image, $mairie_ville
                ));
    
                header('Location:indexconnect.php');
            } else {
                $errorMsg = "La ville indiquée ne correspond à cette mairie.";
            }
            
        //} else {
          //  $errorMsg = "La ville indiquée et l'idMairie ne correspondent pas.";
        //}
        
    } else {
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}
?>
