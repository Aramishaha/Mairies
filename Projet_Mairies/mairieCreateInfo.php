<?php 
//session_start()
require('securityAction.php');  
require('securityActionRole.php');  
require('mairieCreateInfoAction.php'); ?>
<?php include 'head.php'; ?>

<!DOCTYPE html>
<html lang="en">

<body>
    <br><br>
    <form class="container" method="POST">

        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } ?>

        

        <!-- Catégorie avec boutons radio -->
        <div class="mb-3">
            <label class="form-label">Catégorie : choisir entre 'client', 'ancien client', 'radié' ou 'prospect'</label><br>

            <div>
                <input type="radio" id="client" name="categorie" value="client" required>
                <label for="client">Client</label>
            </div>

            <div>
                <input type="radio" id="ancien_client" name="categorie" value="ancien client" required>
                <label for="ancien_client">Ancien Client</label>
            </div>

            <div>
                <input type="radio" id="prospect" name="categorie" value="prospect" required>
                <label for="prospect">Prospect</label>
            </div>

            <div>
                <input type="radio" id="radie" name="categorie" value="radié" required>
                <label for="radie">Radié</label>
            </div>
        </div>

        <!-- Adresse -->
        <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" class="form-control" name="adresse">
        </div>

        <div class="mb-3">
            <label class="form-label">Adresse complément</label>
            <input type="text" class="form-control" name="adresse_complement">
        </div>

        <!-- Code postal -->
        <div class="mb-3">
            <label class="form-label">Code Postal</label>
            <input type="text" class="form-control" name="code_postal">
        </div>

        <!-- Ville -->
        <div class="mb-3">
            <label class="form-label">Ville</label>
            <input type="text" class="form-control" name="ville">
        </div>

        <!-- Ajout du reste du formulaire... -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email">
        </div>

        <div class="mb-3">
            <label class="form-label">Site web</label>
            <input type="text" class="form-control" name="site_web">
        </div>

        <div class="mb-3">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Infos supplémentaires</label>
            <input type="text" class="form-control" name="infos">
            
        </div>
        <div class="mb-3">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Raison sociale</label>
            <input type="text" class="form-control" name="raison_sociale">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Siren</label>
            <input type="text" class="form-control" name="siren">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Population en nombre d'habitants</label>
            <input type="text" class="form-control" name="population">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Année de recensement</label>
            <input type="text" class="form-control" name="annee_recensement">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Maire</label>
            <input type="text" class="form-control" name="maire">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Lundi Matin sous la forme 9h10-12h00</label>
            <input type="text" class="form-control" name="horaireLunM">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Lundi Après-midi sous la forme 14h10-18h00</label>
            <input type="text" class="form-control" name="horaireLunA">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Mardi Matin sous la forme 9h10-12h00</label>
            <input type="text" class="form-control" name="horaireMarM">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Mardi Après-midi sous la forme 14h10-18h00</label>
            <input type="text" class="form-control" name="horaireMarA">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Mercredi Matin sous la forme 9h10-12h00</label>
            <input type="text" class="form-control" name="horaireMerM">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Mercredi Après-midi sous la forme 14h10-18h00</label>
            <input type="text" class="form-control" name="horaireMerA">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Jeudi Matin sous la forme 9h10-12h00</label>
            <input type="text" class="form-control" name="horaireJeuM">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Jeudi Après-midi sous la forme 14h10-18h00</label>
            <input type="text" class="form-control" name="horaireJeuA">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Vendredi Matin sous la forme 9h10-12h00</label>
            <input type="text" class="form-control" name="horaireVenM">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Vendredi Après-midi sous la forme 14h10-18h00</label>
            <input type="text" class="form-control" name="horaireVenA">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Samedi Matin sous la forme 9h10-12h00</label>
            <input type="text" class="form-control" name="horaireSamM">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire Samedi Après-midi sous la forme 14h10-18h00</label>
            <input type="text" class="form-control" name="horaireSamA">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ajouter le lien vers une image</label>
            <input type="text" class="form-control" name="image">
            
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary" name="validate">Ajouter la mairie</button>
        <br><br>
        
    </form>
    
</body>
</html>
