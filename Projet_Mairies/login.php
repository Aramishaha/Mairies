<?php session_start(); // Démarre une session PHP pour pouvoir stocker et accéder aux variables de session.
require('loginAction.php'); // Inclut le fichier 'loginAction.php', qui contient probablement la logique de connexion, comme la validation des identifiants de l'utilisateur.
?>
<?php include 'head.php'; // Inclut un fichier externe 'head.php', qui contient vraisemblablement les balises d'en-tête HTML (comme les meta tags, le lien vers la feuille de style, etc.) pour la page. ?>

<!DOCTYPE html>
<html lang="en"> <!-- Déclare la langue de la page comme étant l'anglais (en) -->

<body>
    <br><br>
    <form class="container" method="POST"> <!-- Le formulaire utilise la méthode POST pour envoyer les données -->

        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } ?> <!-- Si une variable $errorMsg est définie (en cas d'erreur de connexion), elle est affichée ici dans un paragraphe -->

        <div class="mb-3"> <!-- Section pour le champ du pseudo -->
            <label for="exampleInputEmail1" class="form-label">Pseudo</label> <!-- Libellé pour le champ "pseudo" -->
            <input type="text" class="form-control" name="pseudo"> <!-- Champ de saisie pour le pseudo de l'utilisateur -->
        </div>
        
        <div class="mb-3"> <!-- Section pour le champ du mot de passe -->
            <label for="exampleInputPassword1" class="form-label">Password</label> <!-- Libellé pour le champ "mot de passe" -->
            <input type="password" class="form-control" name="password"> <!-- Champ de saisie pour le mot de passe, de type 'password' pour masquer le texte -->
        </div>
        
        <button type="submit" class="btn btn-primary" name="validate">Se connecter</button> <!-- Bouton pour soumettre le formulaire de connexion, qui porte le nom 'validate' pour identifier l'action -->
        
        <br><br>
        <a href="signup.php"><p>S'inscrire</p></a> <!-- Lien vers la page d'inscription pour les utilisateurs qui n'ont pas encore de compte -->
    </form>
    
</body>
</html>
