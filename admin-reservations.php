<?php 
include_once('header-admin.php');
require_once('connection.php');

// Approuver
if(isset($_POST['action']) && $_POST['action'] == 'confirmer' && isset($_POST['id'])) {
    $stmt = $dn->prepare("UPDATE reservation SET approuve = 1 WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

// Rejeter
if(isset($_POST['action']) && $_POST['action'] == 'refuser' && isset($_POST['id'])) {
    $stmt = $dn->prepare("UPDATE reservation SET approuve = 2 WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
}

$sqlex = 'SELECT * FROM reservation ';
$recupReservations = $dn->prepare($sqlex);
$recupReservations->execute();
$Reservations = $recupReservations->fetchAll();
?>

<div class="container">
    <div class="row justify-content-center">
        <?php foreach($Reservations as $reservation): ?>
            <div class="card mb-3 w-75"> <!-- Use w-75 for width control -->
                <div class="card-header text-center">
                   <h4>Réservation au nom de <strong><?= htmlspecialchars($reservation['nom']) ?></strong></h4> 
                </div>

            <div class="card-body">
            <p class="card-text"><strong>Date:</strong> <?=date('j F Y', strtotime($reservation['date']))?></p>
            <p class="card-text"><strong>Horaire:</strong> <?=date('H\hi', strtotime($reservation['horaire']))?></p>
            <p class="card-text"><strong>Nombre de personnes:</strong> <?=($reservation['nombre']); ?></p>
            <p class="card-text"><strong>Email:</strong> <a href="mailto:<?= $reservation['mail']?>"><?=($reservation['mail']); ?></a></p>
            <p class="card-text"><strong>Téléphone:</strong> <a href="tel:<?=$reservation['tel']?>"><?=($reservation['tel']); ?></a></p>
            <p class="card-text">
            <strong>État actuel:</strong> 
            <span class="<?php
                switch ($reservation['approuve']) {
                    case 0:
                        echo 'status-span status-en-attente">En attente';
                        break;
                    case 1:
                        echo 'status-span status-confirme">Confirmé';
                        break;
                    case 2:
                        echo 'status-span status-refuse">Refusé';
                        break;
                }
            ?></span>
        </p>
                    <div class="text-center"> <!-- Button container -->
                        <form method="post" style="display: inline-block;">
                            <input type="hidden" name="action" value="confirmer">
                            <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                            <button type="submit" class="btn btn-success">Confirmer</button>
                        </form>
                        <form method="post" style="display: inline-block;">
                            <input type="hidden" name="action" value="refuser">
                            <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                            <button type="submit" class="btn btn-danger">Refuser</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div> 
</div>
<?php include_once('footer-admin.php');?>



