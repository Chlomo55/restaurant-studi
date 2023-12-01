<?php
require_once('connection.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $checkEmail = $dn->prepare("SELECT * FROM reservation WHERE mail = ?");
    $checkEmail->execute([$email]);
    if ($checkEmail->rowCount() > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}
?>
