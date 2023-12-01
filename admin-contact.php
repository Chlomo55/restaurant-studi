<?php require_once('header-admin.php'); 
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $adresse = $_POST['adresse'];
    $num = $_POST['num'];
    $twitter = $_POST['twitter'];
    $insta = $_POST['insta'];
    $facebook = $_POST['facebook'];

    $modif_sql = "UPDATE contact SET adresse = ?, num = ?, twitter = ?, insta = ?, facebook = ? WHERE id = 1";
    $modif = $dn->prepare($modif_sql);
    $modif->execute([$adresse, $num, $twitter, $insta, $facebook]);
}
?>
    <div class="container">
      <div class="row justify-content-center">
        <main class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <form method="post" class="form-signin text-center">
            <h1 class="h3 mb-3 fw-normal">Modification des coordonnées</h1>
        <div class="form-floating">
            <label for="adresse">Adresse postale</label>
            <input type="text" class="form-control" id="adresse" placeholder="Adresse postale complète" name="adresse">
        </div>
        <div class="form-floating position-relative">
            <label for="num">Numéro de téléphone</label>
            <input type="text" class="form-control" id="num" placeholder="Numéro de téléphone" name="num">
        </div>
        <div class="form-floating position-relative">
            <label for="twitter">Lien du compte X (Twitter)</label>
            <input type="text" class="form-control" id="twitter" placeholder="Lien du compte Twitter" name="twitter">
        </div>
        <div class="form-floating position-relative">
            <label for="insta">Lien du compte Instagram</label>
            <input type="text" class="form-control" id="insta" placeholder="Lien du compte Instagram" name="insta">
        </div>
        <div class="form-floating position-relative">
            <label for="facebook">Lien du compte Facebook</label>
            <input type="text" class="form-control" id="facebook" placeholder="Lien du compte Facebook" name="facebook">
        </div>
           
            <div>
                <button class="btn btn-primary w-50 py-2 my-3" type="submit">Modifier</button>
            </div>
               <p class="mt-5 mb-3 text-body-secondary">© Au bon gourmet - 2023</p>
                </form>
        </main>
    </div>
</div>
</body>
</html>

<?php include_once('footer-admin.php') ;?>