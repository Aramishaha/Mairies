<?php
// Inclusion de fichiers de sécurité pour vérifier l'action de l'utilisateur et son rôle
require('securityAction.php'); 
require('securityActionRole.php'); 
require('mairiedeleteAction.php'); 
?>

<?php include 'head.php'; // Inclusion du fichier d'en-tête (probablement contenant des balises meta, title, etc.) ?>

<!DOCTYPE html>
<html lang="en">

<body>
    <br><br>
    <!-- Début du formulaire de suppression de mairie -->
    <form class="container" method="POST">
        
        <!-- Affichage d'un message d'erreur si la variable $errorMsg est définie -->
        <?php if(isset($errorMsg)){ echo '<p>' . htmlspecialchars($errorMsg) . '</p>'; } ?>

        <!-- Champ caché contenant l'ID de la mairie à supprimer -->
        <input type="hidden" class="form-control" name="idMairie" value="<?php echo htmlspecialchars($_GET['idMairie'] ?? ''); ?>">

        <!-- Champ de saisie pour la ville, l'utilisateur devra entrer le nom de la ville à supprimer -->
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" name="ville" id="ville" required> <!-- Champ obligatoire -->
        </div>

        <!-- Bouton de soumission du formulaire pour valider la suppression -->
        <button type="submit" class="btn btn-primary" name="validate">Supprimer</button>
        <br><br>
    </form>
    
</body>
</html>
