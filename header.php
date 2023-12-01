<?php
ob_start();
session_start();
$admin_bdd = new PDO('mysql:host=localhost;dbname=resto-studi;', 'root', '');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Au bon gourmet</title>
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles pour les grands écrans */
        @media (min-width: 768px) {
            .header-small-screen {
                display: none;
            }
            .header-large-screen {
                display: block;
            }
        }

        /* Styles pour les petits écrans */
        @media (max-width: 767px) {
            .header-large-screen {
                display: none !important;
            }
            .header-small-screen {
                display: block !important;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header pour petits écrans -->
    <header class="navbar navbar-expand-md navbar-light py-3 mb-4 border-bottom header-small-screen">
        <div class="w-100 d-flex flex-column align-items-center">
            <a href="index.php" class="mb-2">
                <img src="logo-resto.png" alt="LOGO" class="logo">     
            </a>

            <button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
            <ul class="navbar-nav mb-2 mb-md-0">
                <li class="nav-item"><a href="index.php" class="nav-link px-2">Accueil</a></li>
                <li class="nav-item"><a href="index.php#horaires" class="nav-link px-2">Horaires</a></li>
                <li class="nav-item"><a href="index.php#reservation" class="nav-link px-2">Réservation</a></li>
                <li class="nav-item"><a href="index.php#contact" class="nav-link px-2">Contact</a></li>
            </ul>

            
        </div><?php if(!isset($_SESSION["user"])): ?>
            <div class="d-flex justify-content-center mt-3">
                <a href="connexion.php" class="me-2"> 
                    <button type="button" class="btn btn-primary">
                        Connexion
                    </button>
                </a>
                <a href="inscription.php">
                    <button type="button" class="btn btn-primary">
                        Inscription
                    </button>
                </a>
            </div>
            <?php else: ?>
                <div class="d-flex justify-content-center mt-3"> 
                    <button type="button" class="btn btn-secondary mx-2">
                        Bonjour <?= $_SESSION["user"]["prenom"]?>
                    </button>
                <a href="deconnexion.php">
                    <button type="button" class="btn btn-secondary">
                        Deconnexion
                    </button>
                </a>
            </div>
            <?php endif?>
    </header>

    <!-- Header for large screens -->
    <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 border-bottom header-large-screen" style="display: none;">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="logo-resto.png" alt="LOGO" class="logo">     
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0" style="background-color: #6F6F6F; border-radius: 15px; padding: 10px;">
            <li><a href="index.php" class="nav-link px-2" style="color: #fff;">Accueil</a></li>
            <li><a href="index.php#horaires" class="nav-link px-2" style="color: #fff;">Horaires</a></li>
            <li><a href="index.php#reservation" class="nav-link px-2" style="color: #fff;">Réservation</a></li>
            <li><a href="index.php#contact" class="nav-link px-2" style="color: #fff;">Contact</a></li>
        </ul>

        <?php if(!isset($_SESSION["user"])): ?>
        <div class="col-md-3 text-end">
            <button type="button" style="background-color: #6F6F6F; border-radius: 10px; padding: 5px;">
                <a href="connexion.php" style="text-decoration: none; color: #fff;"> Connexion</a>
            </button>
        
            <button type="button" style="background-color: #6F6F6F; border-radius: 10px; padding: 5px;">
                <a href="inscription.php" style="text-decoration: none; color: #fff;"> Inscription</a>
            </button>    
        </div>
        <?php else: ?>
            <div class="col-md-3 text-end">
            <button type="button" style="background-color: #6F6F6F; border-radius: 10px; padding: 5px;">
                <a href="compte.php" style="text-decoration: none; color: #fff;">Accès à votre compte</a>
            </button> 
        
            <button type="button" style="background-color: #6F6F6F; border-radius: 10px; padding: 5px;">
                <a href="deconnexion.php" style="text-decoration: none; color: #fff;"> Deconnexion</a>
            </button>    
        </div>
        <p>Bonjour <?= $_SESSION["user"]["prenom"]?></p>
        <?php endif?>
        
    </header>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

