<?php 
ob_start();
// session_start();
require_once('connection.php');
require_once('mon-style.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $tel = $_POST['tel'];
    $time = $_POST['time'];
    $nombre = $_POST['nombre'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Utilisation de PASSWORD_DEFAULT pour le hash
    $email = $_POST['email'];

    $stmt = $dn->prepare("INSERT INTO reservation (date, horaire, nombre, nom, prenom, mail, pass, tel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$date, $time, $nombre, $nom, $prenom, $email, $pass, $tel]);

    $lastId = $dn->lastInsertId();

    // Stockage dans la session
    $_SESSION["user"] = [
        "id" => $lastId,
        "nom" => $nom,
        "prenom" => $prenom,
        "mail" => $email,
        "pass" => $pass,
        "tel" => $tel,
        "date" => $date, 
        "time" => $time
    ];
    header("Location: compte.php");
    exit();    
    }

?>

<div class="div-click1" id="reservation">
    <h3 class="text-center">Reservation</h3>
        <button class="click1 btn btn-secondary mb-4 py-2">Reserver une table</button>
</div>
<div class="form">
    <form method="post" id="myForm">
        <img src="croix-fermer.jpg" width="50" height="50" id="fermer">
       <h4 class="text-center"><i>Réservation de table</i> </h4>

    <hr>
    <div class="username-div">
        
        <div>
            <label for="date">Date souhaité <span class="obligatoire">*</span></label>
            <input type="date" name="date" id="date" placeholder="Date souhaité">
            <span id="errorDate"></span>
        </div>
        <div>
            <label for="time">Heure souhaité <span class="obligatoire">*</span></label>
            <input type="time" name="time" id="time" placeholder="Veuillez choisir un horaire entre 11h30 et 14h et 18h30 et 22h30">
            <span id="errorTime"></span>
        </div>
    </div>
    <div class="username-div">
        <div>
            <label for="nombre">Personnes <span class="obligatoire">*</span></label>
            <input type="number" name="nombre" id="nombre" placeholder="Nombre de personnes">
        </div>
        <div>
            <label for="tel">Numéro de téléphone <span class="obligatoire">*</span></label>
            <input type="tel" name="tel" id="tel" placeholder="Numéro de téléphone mobile">
            <span id="telError"></span>
        </div>
    </div>
    <div class="username-div">
        <div>
            <label for="nom">Nom <span class="obligatoire">*</span></label>
            <input type="text" name="nom" id="nom" placeholder="Nom pour la reservation">
        </div>
        <div>
            <label for="prenom">Prénom <span class="obligatoire">*</span></label>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom pour la reservation">
        </div>
    </div>
    <div class="username-div">
        <div>
            <label for="email">Adresse mail <span class="obligatoire">*</span></label>
            <input type="email" name="email" id="email" placeholder="Email">
            <span id="emailExiste"></span>
        </div>
        <div>
            <label for="pass">Mot de passe <span class="obligatoire">*</span></label>
            <input type="password" name="pass" id="pass"
             placeholder="Le mot de passe doit comporter des lettres, des chiffres et des caractères spéciaux">
            <span id="errorPass"></span>
        </div>
         <span id="error"></span>
        <input type="submit" value="Reserver" class="click2">
        <span><i>En cliquant sur Reserver, vous allez être rediriger vers votre reservation ou vous pourrez suivre celle-ci</i></span>   
    </div>
</form>
    </div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script>
    $(document).ready(() => {
    $('.form').hide();
    $('#fermer').hide();
    // Lorsque l'on clique sur reserver une table le form apparait
    $('.click1').click(function(){
    $('.form').slideDown();
    $('.div-click1').hide();
    $('#fermer').show();
    });
    $('#fermer').click(function(){
     $('.form').slideToggle();
     $('#fermer').hide();
     $('.div-click1').slideToggle();
    })

    // AJAX pour verifier que le mail n'existe pas déja
    function checkEmailExistence(email) {
    $.ajax({
        url: 'check_email.php', // URL du script PHP qui vérifie l'email
        type: 'POST',
        data: {email: email},
        success: function(data) {
            if (data === 'exists') {
                $('#emailExiste').text('Un compte existe déjà avec cette adresse mail, veuillez donc entrer le bon mot de passe associé à ce mail').css('color', 'green');
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


    // A partir de la on vérifie que le form est comme on le souhaite

    let myForm = document.getElementById('myForm');

    myForm.addEventListener('submit', function(e){

    let date =document.getElementById('date');
     // Regle pour la date
    let dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    
    let time =document.getElementById('time');
      // Regles pour l'heure
    let timeRegex = /^([01]\d|2[0-3]):([0-5]\d)$/;

    let nombre =document.getElementById('nombre');
    let nom =document.getElementById('nom');
    let email =document.getElementById('email');

    let pass =document.getElementById('pass');
    // Regle pour que le mot de passe soit composé de chiffres, de lettres et de caractères speciaux
    let PassRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;
    
    let tel =document.getElementById('tel');
    // Regle pour que le numéro de téléphone commence par 06 ou 07 et ait maximum 10 chiffres
    let TelRegex = /^(06|07)\d{8}$/;


    // Vérification que tous les champs de saisie sont remplis
    if(date.value.trim() === "" || time.value.trim() === "" 
    ||nombre.value.trim() === "" ||nom.value.trim() === "" ||
    email.value.trim() === "" ||pass.value.trim() === "" ||
    tel.value.trim() === ""){    
    // Span pour les champs manquants
    let error =document.getElementById('error');
    error.innerHTML = "Tous les champs n'ont pas été remplis";
    error.style.color = 'red';
    e.preventDefault();} 

    //Parametres pour la date
    else if(dateRegex.test(date.value)=== false){
    // Span pour la date incorrect
    let errorDate = document.getElementById('errorDate');
    errorDate.innerHTML = "Le format de date est incorrect";
    errorDate.style.color = 'red';
    e.preventDefault();}
    
    // Parametres pour l'heure
    else if( timeRegex.test(time.value) === false){
    // Span pour time
    let errorTime = document.getElementById('errorTime');
    errorTime.innerHTML = "Le format d'horaire est incorrect";
    errorTime.style.color = 'red';
    e.preventDefault();}

  
    // Parametres pour le mot de passe
    let passError =document.getElementById('errorPass');
    if(pass.value.trim() !== "" && PassRegex.test(pass.value) === false){
    passError.innerHTML = "Le mot de passe doit contenir des chiffres, des lettres et des caracteres spéciaux";
    passError.style.color = 'red';
    e.preventDefault();
    }

    //Parametres pour le numero de téléphone
    let telError =document.getElementById('telError');
    if(tel.value.trim() !== "" && TelRegex.test(tel.value) === false){
    telError.innerHTML = "Numéro de télephone incorrect";
    telError.style.color = 'red';
    e.preventDefault();
    }
   
    })

    });
    </script>
<?php 
ob_end_flush();
?>