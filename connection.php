<?php
$user = 'root';
$password = ''; // à remplir si vous avez un mot de passe
$bdd = 'mysql:host=localhost;dbname=resto-studi;charset=utf8'; // ajout du charset ici

try {
    // On se connecte à la bdd
    $dn = new PDO($bdd, $user, $password);
    // On définit le mode d'erreur à exception
    $dn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
}
?>
