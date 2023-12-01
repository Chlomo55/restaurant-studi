<?php require_once('header-admin.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <main class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <form method="post" class="form-signin text-center">
                    <h1 class="h3 mb-3 fw-normal">Espace d'administration</h1>
                    
    <!-- Modifier Horaires -->
    <div class="form-floating py-1 my-3">      
        <button class="btn btn-primary"><a href="admin-horaires.php" style="color: #fff; text-decoration: none;">Modifier les horaires</a></button>
    </div>
    
    <!-- Consulter les reservations -->
    <div class="form-floating py-2 my-3">
<button class="btn btn-primary"><a href="admin-reservations.php" style="color: #fff; text-decoration: none;">Afficher les reservations</a></button>
    </div>

    <!-- Formules -->
    <div class="form-floating py-2 my-3">
<button class="btn btn-primary"><a href="admin-formules.php" style="color: #fff; text-decoration: none;">Afficher les formules</a></button>
    </div>  

    <!-- Contact -->
     <div class="form-floating py-2 my-3">
<button class="btn btn-primary"><a href="admin-contact.php" style="color: #fff; text-decoration: none;">Modifier les infos de contact - réseaux sociaux</a></button>
    </div>

    <!-- Site en mode visiteur -->
    <div class="form-floating py-2">
     <button class="btn btn-primary"><a href="index.php" style="color: #fff; text-decoration: none;">Visualiser le site en tant qu'utilisateur</a></button>
    </div>

        </form>
    </main>
</div>
</div>
</body>
</html>

<?php require_once('footer-admin.php'); ?>
