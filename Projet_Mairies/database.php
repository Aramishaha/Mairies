<?php
    try {
        $bdd=new PDO('mysql:host=localhost;dbname=mairies_db;charset=utf8','root','');
    } catch (Exception $e) {
        die('Une erreur a été trouvé : ' . $e->getMessage());
    }
?>
