<?php 

require_once('header.php');
require_once('connection.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php'); // Redirection si l'utilisateur n'est pas connecté
    exit();
}

$mail = $_SESSION['user']['mail'];
$stmt = $dn->prepare("SELECT * FROM reservation WHERE mail = ?");
$stmt->execute([$mail]);
$comptes = $stmt->fetchAll();

?>
  <style>
        /* Styles personnalisés */
        .card-header {
            background-color: #f8f9fa; /* Couleur de fond pour l'en-tête de la carte */
            border-bottom: 1px solid #e3e6f0;
        }
        .card-body {
            background-color: #ffffff; /* Couleur de fond pour le corps de la carte */
        }
        .status-span {
            padding: 0.25em 0.5em;
            border-radius: 0.25rem;
            color: #fff;
            font-weight: bold;
        }
        .status-en-attente {
            background-color: #ffc107; /* Jaune pour 'En attente' */
        }
        .status-confirme {
            background-color: #28a745; /* Vert pour 'Confirmé' */
        }
        .status-refuse {
            background-color: #dc3545; /* Rouge pour 'Refusé' */
        }
    </style>

      


    <!-- Ajouter le fait de pouvoir modifier la reservation sans le pass -->
<div class="container my-4">
        <h3 class="text-center mb-4">Mes réservations</h3>
        <!-- Afficher les reservations seulement si dans la ligne la date, l'horaire et le nombre 
        ne sont pas inferieurs à 0, sinon afficher "Aucune réservation encore chez nous" -->
        <?php
        foreach($comptes as $compte):
        
            if($compte['nombre'] > 0 && !empty($compte['date']) && !empty($compte['horaire'])) { 
                ?>
        <div class="card mb-3">
            <div class="card-header font-weight-bold text-center">
                Réservation au nom de <?=$compte['prenom'].' '.$compte['nom'] ?>
            </div>
            <div class="card-body text-center">


                <h5 class="card-title"><i>Details de votre réservation</i></h5>
                <p class="card-text"><strong>Date:</strong> <?=date('j F Y', strtotime($compte['date']))?></p>
                <p class="card-text"><strong>Horaire:</strong> <?=date('H\hi', strtotime($compte['horaire']))?></p>
                <p class="card-text"><strong>Nombre de personnes:</strong> <?= ($compte['nombre']); ?></p>
                <p class="card-text"><strong>Email:</strong> <?= ($compte['mail']); ?></p>
                <p class="card-text"><strong>Téléphone:</strong> <?= ($compte['tel']); ?></p>
                <p class="card-text">
                    <strong>État:</strong> 
                    <span class="<?php
                        switch ($compte['approuve']) {
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
            </div>
        </div>
        <?php } else{ ?>
             <div class="card mb-3">
             <div class="card-header font-weight-bold text-center">
             Réservation au nom de <?= $compte['prenom'].' '.$compte['nom']?>
             </div>
             <div class="card-body text-center">
                 <h5 class="card-title">Aucune réservation trouvé à votre nom</h5>
             </div> 
              
             <div class="text-center">
                <a href="index.php/#reservation"><button class="btn btn-primary mb-3">Nouvelle réservation</button></a>
             </div>
        <?php } endforeach?>
    </div>

<?php include_once('footer.php');?>