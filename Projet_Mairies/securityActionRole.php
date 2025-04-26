<?php
// Vérifie si la variable de session 'role' est définie et si la valeur de cette variable est 'admin'
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Si la session 'role' est définie et égale à 'admin', le code à l'intérieur du bloc `if` s'exécute (vide dans ce cas).
}
else{
    // Si la session 'role' n'est pas définie ou que sa valeur n'est pas 'admin', redirige l'utilisateur vers la page 'indexconnect.php'
    header('Location: indexconnect.php');
}
?>
