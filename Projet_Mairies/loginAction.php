<?php
require('database.php');

//validation du formulaire d'inscription
if(isset($_POST['validate'])){

    //Vérifier si l'utilisatteur a bien compléter tous les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['password'])){

        //Les données de l'utilisateur
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password = htmlspecialchars($_POST['password']);

        //Vérifie si l'utilisateur existe
        $chechIfUserExists = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo = ?');
        $chechIfUserExists->execute(array($user_pseudo));

        if($chechIfUserExists->rowCount() > 0){


            //Récupérer les données de l'utilisateur
            $userInfos = $chechIfUserExists->fetch();
            
            //Vérifier si le mot de passe est correct( si le pseudo existe)
            if(password_verify($user_password, $userInfos['password'] )){

                    //Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales session
                    $_SESSION['auth'] = true ;
                    $_SESSION['id'] = $userInfos['idUser'];
                    $_SESSION['pseudo'] = $userInfos['pseudo'];
                    $_SESSION['role'] = $userInfos['role'];
                    $_SESSION['login.php'] = "ok";
                    //Rediriger l'utilisateur vers la page d'acceuil
                    header('Location:indexconnect.php');

            }else{
                $errorMsg = "Votre mot de passe est incorrect...";
            }
            
        }else{
            $errorMsg = "Votre pseudo est incorrect...";
        }

     
            
      

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}




?>