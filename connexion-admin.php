<?php
session_start(); 

if(!empty($_POST)){
   // Le form est envoyé
   //On vérifie que tous les champs sont remplis
   if(isset($_POST["email"], $_POST["pass"])
    && !empty($_POST["email"] && !empty($_POST["pass"]))){
    //On vérifie que l'email en est est un
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
    {
        die("Mail invalide");
}
//On se connecte à la bdd

require_once("connection.php");

$sql = "SELECT * FROM `admin` WHERE `mail` = :email";

$query = $dn->prepare($sql);

$query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
$query->execute();

$admin =$query->fetch();
if(!$admin){
    header("Location: index.php");
}

//On a donc maintenant le bon utilisateur


if(!password_verify($_POST["pass"], $admin["pass"])){
    die("Mail et/ou mot de passe incorrects");
}

//ici on sait que l'on a affaire à la bonne personne
//On connecte l'user mais ici l'admin


// //On stocke les infos de l'admin

$_SESSION["admin"] = [
    "id" => $admin["id"],
    "email"=> $admin["mail"],
    "pass" => $admin["pass"]
];

//On peut rediriger 
header("location: admin.php");

}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Connexion</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-body-tertiary">
    <div class="container">
        <div class="row justify-content-center">
            <main class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <form method="post" class="form-signin text-center">
                    <img class="mb-4" src="logo-resto.png" alt="" width="150" height="135">
                    <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>
                    <div class="form-floating">
            <label for="floatingInput">Adresse mail</label>
<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
    </div>
    <div class="form-floating">      
        <label for="floatingPassword">Mot de passe</label>
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass">
    </div>

                <button class="btn btn-primary w-100 py-2 my-3" type="submit">Se connecter</button>
                <button class="btn btn-primary w-100 py-2 my-3" type="button"><a href="connexion-admin.php" style="text-decoration: none; color: #fff;">Connexion Utilisateur</a></button>
                <button class="btn btn-primary w-100 py-2 my-3" type="button"><a href="index.php" style="text-decoration: none; color: #fff;">Retour au site</a></button>
                    <p class="mt-5 mb-3 text-body-secondary">© Au bon gourmet - 2023</p>
                </form>
            </main>
        </div>
    </div>
</body>
</html>