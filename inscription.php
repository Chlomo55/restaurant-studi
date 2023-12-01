<?php
 //On démarre la session php
session_start();

//On vérifie si le formulaire a bien été envoyé
if(!empty($_POST)){
    //Le formulaire a été envoyé
    //On vérifie que TOUS les chmps requis sont remplis
  if(isset($_POST["name"], $_POST["firstname"],
   $_POST["email"], $_POST["pass"])
     && !empty($_POST["name"]) && !empty($_POST["firstname"])
     && !empty($_POST["email"]) && !empty($_POST["pass"])
   ){
       //Le formulaire est complet
       //On récupére les données en es protégeant

        $pseudo = strip_tags($_POST["firstname"]);
        $nom = strip_tags($_POST["name"]);


        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            die("Adresse mail invalide");
        }

        //On va hasher le mdp
        $pass = password_hash($_POST["pass"], CRYPT_EXT_DES);

      //On enregistre en bdd
        require_once('connection.php');

        $sql = "INSERT INTO `reservation`(`nom`, `prenom`, `mail`, `pass`)
         VALUES (:name, :firstname, :email, '$pass')";

        $query = $dn->prepare($sql);

        $query->bindValue(":firstname", $pseudo, PDO::PARAM_STR);
        $query->bindValue(":name", $nom, PDO::PARAM_STR);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        //On récupére l'id du nouvel user
        $id = $dn->lastInsertId();

        //ON CONNECTERA L'UTILISATEUR
       

         //On stoke dans $_SESSION les information s de l'utilisateur
 
         $_SESSION["user"] = [
             "id" => $id,
             "name" => $nom,
             "pseudo" => $pseudo,
             "email" => $_POST["email"]
         ];
 
         //On peut rediriger vers ce que l'on veut
         header('Location: compte.php');



   } }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Inscription</title>
    <style>
    .eye-icon {
    position: absolute;
    top: 70%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-body-tertiary">
    <div class="container">
      <div class="row justify-content-center">
        <main class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <form method="post" class="form-signin text-center" id="myForm">
                <img class="mb-4" src="logo-resto.png" alt="" width="150" height="135">
            <h1 class="h3 mb-3 fw-normal">Inscription</h1>
            <div class="form-floating">
            <label for="floatingInput">Nom</label>
            <input type="text" name="name" class="form-control" id="nom">
            </div>
            <div class="form-floating">
                <label for="floatingInput">Prénom</label>
                <input type="text" name="firstname" class="form-control" id="prenom">
            </div>
            <div class="form-floating">
            <label for="floatingInput">Adresse mail</label>
            <input type="email" name="email" class="form-control" placeholder="name@example.com" id="email">
            <span id="emailExiste"></span>
        </div>
        <div class="form-floating position-relative">
            <label for="floatingPassword">Mot de passe</label>
            <input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
            <i data-feather="eye" class="eye-icon"></i>
            <i data-feather="eye-off" class="eye-icon" style="display:none;"></i>
            <span id="errorPass"></span>
        </div>

    <span id="error"></span>

            <div>
                <button class="btn btn-primary w-50 py-2 my-3" type="submit">S'inscire</button>
                <button class="btn btn-primary w-50 py-2 my-3" type="button"><a href="connexion.php" style="text-decoration: none; color: #fff;">Déja chez nous?</a></button>
            </div> 
            <div>
                <button class="btn btn-primary w-50 py-2 my-3" type="button"><a href="connexion-admin.php" style="text-decoration: none; color: #fff;">Connexion Admin</a></button>
                <button class="btn btn-primary w-50 py-2 my-3" type="button"><a href="index.php" style="text-decoration: none; color: #fff;">Retour au site</a></button>
            </div>
               <p class="mt-5 mb-3 text-body-secondary">© Au bon gourmet - 2023</p>
                </form>
        </main>
    </div>
</div>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

<script>
feather.replace();
const eye = document.querySelector(".feather-eye");
const eyeoff = document.querySelector(".feather-eye-off");
const passwordField = document.getElementById("floatingPassword");

eye.addEventListener("click", () => {
  eye.style.display = "none";
  eyeoff.style.display = "block";
  passwordField.type = "text";
});

eyeoff.addEventListener("click", () => {
  eyeoff.style.display = "none";
  eye.style.display = "block";
  passwordField.type = "password";
});
// AJAX pour verifier que le mail n'existe pas déja
function checkEmailExistence(email) {
$.ajax({
    url: 'check_email.php', // URL du script PHP qui vérifie l'email
    type: 'POST',
    data: {email: email},
    success: function(data) {
        if (data === 'exists') {
            $('#emailExiste').text('Un compte existe déjà avec cette adresse mail, connectez-vous').css('color', 'red');
        } else {
            $('#emailExiste').text('');
        }
    }
});
}
// Événement pour vérifier l'email lors de la saisie
$('#email').on('input', function() {
    var email = $(this).val();
    if (email) {
        checkEmailExistence(email);
    } else {
        $('#emailExiste').text('');
    }
});
document.addEventListener('DOMContentLoaded', (event) => {
    feather.replace();
    const eye = document.querySelector(".feather-eye");
    const eyeoff = document.querySelector(".feather-eye-off");
    const passwordField = document.getElementById("pass");

    eye.addEventListener("click", () => {
        eye.style.display = "none";
        eyeoff.style.display = "block";
        passwordField.type = "text";
    });

    eyeoff.addEventListener("click", () => {
        eyeoff.style.display = "none";
        eye.style.display = "block";
        passwordField.type = "password";
    });

    // Reste de votre code pour la vérification AJAX

    let myForm = document.getElementById('myForm');

    myForm.addEventListener('submit', function(e) {
        let nom = document.getElementById('nom');    
        let prenom = document.getElementById('prenom');
        let email = document.getElementById('email');
        let pass = document.getElementById('pass');
        let PassRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        let error = document.getElementById('error');
        error.innerHTML = "";
        error.style.color = 'red';

        if (nom.value.trim() === "" || prenom.value.trim() === "" || email.value.trim() === "" || pass.value.trim() === "") {
            error.innerHTML = "Tous les champs n'ont pas été remplis";
            e.preventDefault();
        }

        let passError = document.getElementById('errorPass');
        passError.innerHTML = "";
        passError.style.color = 'red';

        if (pass.value.trim() !== "" && !PassRegex.test(pass.value)) {
            passError.innerHTML = "Le mot de passe doit contenir des chiffres, des lettres et des caractères spéciaux, et être d'au moins 8 caractères.";
            e.preventDefault();
        }
    });
});
</script>
</body>
</html>

