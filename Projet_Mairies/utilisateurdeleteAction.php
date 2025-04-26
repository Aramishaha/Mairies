<?php
require('database.php');

// Validation du formulaire de suppression
if (isset($_POST['validate'])) {

    // Vérifier si l'utilisateur a bien complété tous les champs
    if (!empty($_POST['pseudo'])) {

        // Les données de l'utilisateur
        $user_pseudo = htmlspecialchars($_POST['pseudo']);

        // Vérifier si l'utilisateur existe
        $checkIfUserExists = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = ?');
        $checkIfUserExists->execute(array($user_pseudo));

        if ($checkIfUserExists->rowCount() > 0) {

            // Supprimer l'utilisateur de la base de données
            $deleteUser = $bdd->prepare('DELETE FROM utilisateur WHERE pseudo = ?');
            $deleteUser->execute(array($user_pseudo));

            // Rediriger l'utilisateur vers une page de confirmation
            header('Location:indexconnect.php');
            exit();

        } else {
            $errorMsg = "Le pseudo que vous avez entré n'existe pas.";
        }

    } else {
        $errorMsg = "Veuillez compléter le champ pseudo.";
    }
}
?>

