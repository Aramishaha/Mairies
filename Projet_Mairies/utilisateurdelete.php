<?php 
//session_start();
require('securityAction.php');
require('securityActionRole.php'); 
require('utilisateurdeleteAction.php'); ?>
<?php include 'head.php'; ?>

<!DOCTYPE html>
<html lang="en">

<body>
    <br><br>
    <form class="container" method="POST">

        <?php if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } ?>


       
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Pseudo</label>
            <input type="text" class="form-control" name="pseudo">
        </div>
        <button type="submit" class="btn btn-primary" name="validate">Supprimer</button>
        <br><br>
        
    </form>
    
</body>
</html>