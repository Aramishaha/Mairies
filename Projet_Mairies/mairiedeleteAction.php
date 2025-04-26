<?php
require('database.php');

// Validation du formulaire de suppression
if (isset($_POST['validate'])) {

    // Vérifier si l'utilisateur a bien complété tous les champs
    if (!empty($_POST['ville'])) {

        // Les données de l'utilisateur
        $user_pseudo = htmlspecialchars($_POST['ville']);
        $mairie_id = htmlspecialchars($_POST['idMairie']);

        // Vérifier si la mairie existe
        $checkIfUserExists = $bdd->prepare('SELECT * FROM mairies WHERE ville = ?');
        $checkIfUserExists->execute(array($user_pseudo));

        // Vérifier si l'idMairie correspond à celui de la ville 

        $checkIfidMairiesMatchVille = $bdd->prepare('SELECT idMairie FROM mairies WHERE ville = ?');
        $checkIfidMairiesMatchVille->execute(array($user_pseudo));

        //Cette fonctionnalité ne fonctionne pas encore : if ($checkIfidMairiesMatchVille === $mairie_id) {

            if ($checkIfUserExists->rowCount() > 0) {

                // Supprimer la mairie de la base de données
                $deleteUser = $bdd->prepare('DELETE FROM mairies WHERE ville = ?');
                $deleteUser->execute(array($user_pseudo));
    
                // Rediriger l'utilisateur vers une page de confirmation
                header('Location:indexconnect.php');
                exit();
    
            } else {
                $errorMsg = "La ville que vous avez entré n'existe pas.";
            }

       // } else {
          //   $errorMsg = "La ville que vous avez entrée ne correspond pas à cette mairie.";
        //}
        

    } else {
        $errorMsg = "Veuillez compléter le champ ville.";
    }
}
?>

