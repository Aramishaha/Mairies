<?php
require('database.php');

//validation du formulaire d'inscription
if(isset($_POST['validate'])){

    //Vérifier si l'utilisatteur a bien compléter tous les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['password'])){

        //Les données de l'utilisateur
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //Vérifie si l'utilisateur existe
        $chechIfUserExists = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = ?');
        $chechIfUserExists->execute(array($user_pseudo));

        if($chechIfUserExists->rowCount() > 0){


            //Récupérer les données de l'utilisateur
            $userInfos = $chechIfUserExists->fetch();

            // Mettre à jour le mot de passe dans la base de données
            $updatePassword = $bdd->prepare('UPDATE utilisateur SET password = ? WHERE pseudo  = ?');
            $updatePassword->execute(array($user_password,$user_pseudo ));

            header('Location:indexconnect.php');
            
            
            
        }else{
            $errorMsg = "Votre pseudo est incorrect...";
        }

     
            
      

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}




?>