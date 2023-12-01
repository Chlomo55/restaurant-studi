<?php 
include_once('header-admin.php');
require_once('connection.php');

// Mise à jour des horaires si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jour = $_POST['jour'];
    $ouverture = $_POST['ouverture_matin'];
    $fermeture = $_POST['fermeture_matin'];
    $ouverture_pm = $_POST['ouverture_soir'];
    $fermeture_pm = $_POST['fermeture_soir'];
    $ferme = isset($_POST['ferme']) ? 1 : 0;

    $stmt = $dn->prepare("UPDATE horaires SET ouverture_matin = ?, fermeture_matin = ?, ouverture_soir = ?, fermeture_soir = ?, ferme = ? WHERE jour = ?");
    $stmt->execute([$ouverture, $fermeture, $ouverture_pm, $fermeture_pm, $ferme, $jour]);
}

// Récupération des horaires existants
$stmt = $dn->prepare("SELECT * FROM horaires ORDER BY id");
$stmt->execute();
$jours = $stmt->fetchAll();
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="container bg-white py-4 rounded shadow">
                    <h3 class="text-center mb-4" style="color: #007BFF;">Mise à jour des horaires du restaurant</h3>
                    <form method="post">
                        <div class="mb-3 px-2">
                            <label for="jour" class="form-label">Jour de la semaine :</label>
                            <select class="form-select" id="jour" name="jour">
                                <option value="Lundi">Lundi</option>
                                <option value="Mardi">Mardi</option>
                                <option value="Mercredi">Mercredi</option>
                                <option value="Jeudi">Jeudi</option>
                                <option value="Vendredi">Vendredi</option>
                                <option value="Samedi">Samedi</option>
                                <option value="Dimanche">Dimanche</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="ouverture_matin" class="form-label">Heure d'ouverture (matin) :</label>
                            <input type="time" class="form-control" id="ouverture_matin" name="ouverture_matin">
                        </div>

                        <div class="mb-3">
                            <label for="fermeture_matin" class="form-label">Heure de fermeture (matin) :</label>
                            <input type="time" class="form-control" id="fermeture_matin" name="fermeture_matin">
                        </div>

                        <div class="mb-3">
                            <label for="ouverture_soir" class="form-label">Heure d'ouverture (soir) :</label>
                            <input type="time" class="form-control" id="ouverture_soir" name="ouverture_soir">
                        </div>

                        <div class="mb-3">
                            <label for="fermeture_soir" class="form-label">Heure de fermeture (soir) :</label>
                            <input type="time" class="form-control" id="fermeture_soir" name="fermeture_soir">
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="ferme" name="ferme">
                            <label class="form-check-label" for="ferme">Fermé :</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" style="background-color: #007BFF; border-color: #007BFF;">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclure Bootstrap JavaScript (à partir d'un CDN) si nécessaire -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>
</body>
<?php include_once('footer-admin.php');?>
</html>
