<?php 

$contact = $admin_bdd->query("SELECT * FROM contact");?>
<div class="text-center" id="contact">
    <h3>Contact</h3>
</div>
<?php
while($contacts = $contact->fetch()){
    ?>
    
    <div class="container text-center">
        <p><?= $contacts['adresse']?></p>
        <span>S'y rendre avec <a href="https://www.google.com/maps/dir/?api=1&destination=75+Avenue+Henri+Barbusse,+93220+Gagny" target="_blank">
            <br>
            <img src="google-maps.png" height="50" width="50"></a></span>
        <p><img src="icons8-tel-58.png" height="30" width="30" class="mx-2"><a href="tel:+33148553901"><?= $contacts['num']?></a></p>

    </div>
    <?php
}
?>