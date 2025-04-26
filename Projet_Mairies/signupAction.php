<?php

session_start();
require('database.php');

//validation du formulaire d'inscription
if(isset($_POST['validate'])){

    //Vérifier si l'utilisatteur a bien compléter tous les champs
    if(!empty($_POST['pseudo'])  AND !empty($_POST['email']) AND !empty($_POST['role']) AND !empty($_POST['password'])){

        //Les données de l'utilisateur
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_email = htmlspecialchars($_POST['email']);
        $user_role = htmlspecialchars($_POST['role']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //Vérifier si l'utilisateur existe déja
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = ?');
        $checkIfUserAlreadyExists->execute(array($user_pseudo));

        if($checkIfUserAlreadyExists->rowCount() == 0){

            //Insérer l'utilisateur dans la bdd
            //mettre en autoincrémentation l'id et appelé mdp password dans la base
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO utilisateur(pseudo, email, role, password)VALUES(?, ?, ?, ?)');
            $insertUserOnWebsite->execute(array($user_pseudo, $user_email, $user_role, $user_password));

            //Récupérer les informations de l'utilisateur
            $getInfosOfThisUserReq = $bdd->prepare('SELECT idUser, pseudo FROM utilisateur WHERE pseudo = ?');
            $getInfosOfThisUserReq->execute(array($user_pseudo));

            $userInfos = $getInfosOfThisUserReq->fetch();

            //Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales session
            $_SESSION['auth'] = true ;
            $_SESSION['idUser'] = $userInfos['idUser'];
            $_SESSION['pseudo'] = $userInfos['pseudo'];
            $_SESSION['role'] = $userInfos['role'];
            
            //Rediriger l'utilisateur vers la page d'acceuil
            header('Location: login.php');
            
        }else{
            $errorMsg = "L'utilisateur existe déja sur le site";
        }

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}
?>