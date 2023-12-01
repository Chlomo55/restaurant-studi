<?php
ob_start();
$formules = $admin_bdd->query('SELECT * FROM formules');?>

<div class="container text-center" id="menu">
    <h3>Nos formules</h3>
</div>

<?php
while($affich_menu = $formules->fetch()){
    ?>

<div class="ordi-margin d-flex flex-column p-4 gap-4 py-md-5 justify-content-center">
  <div class="list-group">
    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
      <div class="d-flex gap-2 w-100 justify-content-between">
        <div>
          <h6 class="mb-0"><?= $affich_menu['nom_formule']?></h6>
          <p class="mb-0 opacity-75"><?= $affich_menu['details']?></p>
        </div>
        <h5 class="opacity-50 text-nowrap"><?=$affich_menu['prix'].'€'?></h5>
      </div>
    </a>
  </div>
</div>
<?php 
}?>
<div class="container text-center">
<div class="form-floating pb-2 mb-4 text-center">
  <img src="menu icon.jpg" class="logo">
  <br>
<button style="background-color: red; border-radius: 15px;"><a href="menu.php" style="text-decoration: none; color: #fff;">Voir le menu complet</a></button>
    </div></div>
<style>
@media (min-width: 768px){
.ordi-margin{
margin-left: 30% !important;
margin-right: 30% !important;
}   
    }

</style>