<?php
require_once('my-style.php');
$horaires = $admin_bdd->query('SELECT * FROM horaires');?>
<div class="text-center" id="horaires">        
    <h5 class="card-header mb-4">Horaires</h5>
    <button id="button-horaires" class="btn btn-secondary mb-4 py-2">Afficher les horaires</button>
</div>
<div class="text-center mb-4">        
    <button id="fermer-horaires" class="btn btn-secondary mb-4 py-2">Fermer</button>
</div>

<div class="row justify-content-center" id="affiche-horaires">
<div class="col-lg-4 col-md-6 col-sm-14 mb-4">
    <div class="card h-100">
        
<?php 
while($horaire = $horaires->fetch()){
    ?>
        <div class="card-body text-center">
        <h6 class="h6"><?=$horaire['jour']; ?></h6>
        <?php if($horaire['ferme']): ?>
            <p class="p">Fermé</p>
        <?php else: ?>
            <p class="p"><?= date('H\hi', strtotime($horaire['ouverture_matin'])) ?> - <?= date('H\hi', strtotime($horaire['fermeture_matin'])) ?></p>
            <p class="p"><?= date('H\hi', strtotime($horaire['ouverture_soir'])) ?> - <?= date('H\hi', strtotime($horaire['fermeture_soir'])) ?></p>
        <?php endif; ?>
    </div>
    <?php
}
?>
</div>
</div>
</div>
</div>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script>
     $(document).ready(() => {
        $('#affiche-horaires').hide();
        $('#fermer-horaires').hide();
        $('#button-horaires').click(function(){
            $('#affiche-horaires').show(500);
            $('#fermer-horaires').show();
            $('#button-horaires').hide();
        });
        $('#fermer-horaires').click(function(){
            $('#affiche-horaires').hide(500);
            $('#fermer-horaires').hide();
            $('#button-horaires').show();
        });
     });
</script>


