<?php
session_start();
$bon = false; // Variable pour suivre si les identifiants sont corrects

if (!empty($_POST)) {
    if (isset($_POST["email"], $_POST["pass"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            echo "Ce n'est pas un email valide";
        } else {
            require_once("connection.php");
            $sql = "SELECT * FROM reservation WHERE mail = :email";
            $query = $dn->prepare($sql);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->execute();

            $user = $query->fetch();
            if ($user && password_verify($_POST["pass"], $user["pass"])) {
                // Maintenant, récupérez également le nom et le prénom
                $sql2 = "SELECT nom, prenom FROM reservation WHERE mail = :email";
                $query2 = $dn->prepare($sql2);
                $query2->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                $query2->execute();
                $userInfo = $query2->fetch();

                $_SESSION["user"] = [
                    "id" => $user["id"],
                    "mail" => $user["mail"],
                    "nom" => $userInfo["nom"], // Stockez le nom depuis la deuxième requête
                    "prenom" => $userInfo["prenom"] // Stockez le prénom depuis la deuxième requête
                ];
                header('Location: compte.php');
                exit;
            } else {
                $bon = true; // Mise à jour de la variable si l'adresse e-mail ou le mot de passe est incorrect
            }
        }
    } else {
        echo "Veuillez remplir tous les champs";
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
            <form method="post" class="form-signin text-center">
                <img class="mb-4" src="logo-resto.png" alt="" width="150" height="135">
            <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>
        <div class="form-floating">
            <label for="floatingInput">Adresse mail</label>
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>
        <div class="form-floating position-relative">
            <label for="floatingPassword">Mot de passe</label>
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass">
            <i data-feather="eye" class="eye-icon"></i>
            <i data-feather="eye-off" class="eye-icon" style="display:none;"></i>
        </div>
            <?php if($bon){ ?>
            <div><p style="color: red;">Adresse mail ou mot de passe incorrect</p></div>
            <?php } ?>
            <div>
                <button class="btn btn-primary w-50 py-2 my-3" type="submit">Se connecter</button>
                <button class="btn btn-primary w-50 py-2 my-3" type="button"><a href="inscription.php" style="text-decoration: none; color: #fff;">S'inscrire</a></button>
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

</script>
</body>
</html>

