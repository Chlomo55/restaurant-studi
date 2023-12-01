<?php 
include_once('header-admin.php');
require_once('connection.php');

if($_SERVER["REQUEST_METHOD"] === "POST"){
$nom = $_POST['nom'];
$details = $_POST['details'];
$prix = $_POST['prix'];
$action = $_POST['action'];



// Gestion des actions
if ($action === 'modifier' && $id) {
    $stmt = $dn->prepare("UPDATE formules SET nom_formule = ?, details = ?, prix = ? WHERE id = ?");
    $stmt->execute([$nom, $details, $prix, $id]);    
} elseif ($action === 'supprimer' && $id) {
    $stmt = $dn->prepare("DELETE FROM formules WHERE id = ?");
    $stmt->execute([$id]);
}
}
// Récupération des formules
$sqlex = 'SELECT * FROM formules';
$recupFormules = $dn->prepare($sqlex);
$recupFormules->execute();
$Formules = $recupFormules->fetchAll();

include_once('ajout-formules.php');
?>

<div class="row justify-content-center">
    <?php foreach($Formules as $formule): ?>
        <div class="card mb-3 w-75">
            <!-- Affichage de la formule -->
            <div class="card-header text-center">
               <h4>Nom de la formule : <?=$formule['nom_formule']?></h4> 
            </div>
            <div class="formule">
                <p class="card-text">Détails : <?= $formule['details']?></p>
                <p class="card-text">Prix : <?= $formule['prix']?></p>
                <div class="text-center">
                    <form method="post" style="display: inline-block;">
                        <input type="hidden" name="action" value="modifier">
                        <input type="hidden" name="id" value="<?= $formule['id'] ?>">
                        <button type="button" class="btn btn-success button-modif" data-id="<?= $formule['id'] ?>">Modifier</button> <!-- Bouton Modifier -->
                    </form>
                    <form method="post" style="display: inline-block;">
                        <input type="hidden" name="action" value="supprimer">
                        <input type="hidden" name="id" value="<?= $formule['id'] ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>

            <!-- Formulaire de modification (caché par défaut) -->
            <div id="modif-<?= $formule['id'] ?>" class="modif-form" style="display: none;">
                <form method="post">
                    <input type="hidden" name="action" value="modifier">
                    <input type="hidden" name="id" value="<?= $formule['id'] ?>">
                    <label for="nom">Nom de la formule</label>
                    <input type="text" name="nom" value="<?= $formule['nom_formule'] ?>">
                    <br>
                    <label for="details">Détails de la formule</label>
                    <input type="text" name="details" value="<?= $formule['details'] ?>">
                    <br>
                    <label for="prix">Prix</label>
                    <input type="number" name="prix" value="<?= $formule['prix'] ?>">
                    <button type="submit">Modifier</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include_once('footer-admin.php');?>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(() => {
        $('.button-modif').click(function(){
            var id = $(this).data('id');
            $('#modif-' + id).toggle(); // Afficher ou cacher le formulaire spécifique
        });
    });
</script>



