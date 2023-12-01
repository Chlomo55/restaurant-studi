<?php 

require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $details = $_POST['details'];
    $prix = $_POST['prix'];

    $sql_ajout = "INSERT INTO formules (nom_formule, details, prix) VALUES (,gza   ²&  bnm?, ?, ?)";
    $query = $dn->prepare($sql_ajout);
    $query->execute([$nom, $details, $prix]);
}


?>
<div class="text-center mb-4">
    <button class="btn btn-primary" id="button-ajout">Ajouter une formule</button>
</div>
<div class="text-center mb-4">
    <button class="btn btn-primary" id="fermer-ajout">Fermer</button>
</div>
<div class="container" id="ajout">
        <div class="row justify-content-center">
            <main class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
    <form method="post" class="form-signin text-center">
    <h3 class="h3 mb-3 fw-normal">Ajouter une formule</h3>
    <div class="form-floating">
    <label for="nom">Nom de la formule</label>
    <br>
    <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="form-floating">      
    <label for="details">Description</label>
    <br>
    <input type="text" class="form-control" id="details" name="details">
    </div>
    <div class="form-floating">      
    <label for="prix">Prix (€)</label>
    <br>
    <input type="number" class="form-control" id="prix" name="prix">
    </div>

    <button class="btn btn-primary w-100 py-2 my-3" type="submit">Ajouter</button>
    </form>
</main>
</div>
</div>
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script>
     $(document).ready(() => {
        $('#ajout').hide();
        $('#fermer-ajout').hide();
$('#button-ajout').click(function() {
    $('#ajout').show();
    $('#button-ajout').hide();
    $('#fermer-ajout').show();
});
$('#fermer-ajout').click(function() {
    $('#ajout').hide();
    $('#button-ajout').show();
    $('#fermer-ajout').hide();
});
     })
</script>