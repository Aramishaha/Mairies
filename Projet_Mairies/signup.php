<?php include 'head.php'; ?>

<!DOCTYPE html>
<html lang="en">

<body>
    <br><br>
    <form class="container" action="signupAction.php" method="POST">

        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } ?>

        


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control" name="email">
            
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pseudo</label>
            <input type="text" class="form-control" name="pseudo">
            
        </div>
         <!-- Catégorie avec boutons radio -->
         <div class="mb-3">
            <label class="form-label">Rôle: choisir entre 'user' ou 'admin'</label><br>

            <div>
                <input type="radio" id="user" name="role" value="user" required>
                <label for="user">Utilisateur</label>
            </div>

            <div>
                <!-- Changer la value de l'administrateur et le label/ par défault car il n'y a pas d'autre administrateur de prévu -->
                <input type="radio" id="admin" name="role" value="user" required>
                <label for="user">Administrateur</label>
            </div>

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="validate">S'inscrire</button>
        <br><br>
        <a href="login.php"><p>J'ai déjà un compte. Je me connecte</p></a>
    </form>
    
    


    
</body>
</html>