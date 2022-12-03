<?php
    session_start(); // obrim la sessió

    $host = "localhost";
    $root = "root";
    $bbdd = "bbdd_ailled";

    // Fem la connexió
    $connexio = new mysqli("$host", "$root", "", "$bbdd");
    $connexio->set_charset("utf8");

    // ----------------- //

    // Connexió per a la PDO
    $connexio_PDO = new PDO("mysql:host=$host; dbname=$bbdd", "$root", "");

    // ----------------- //

    // SESSIÓ EXPIRADA
    $expireAfter = 30;

    if (isset($_SESSION['last_action'])) {
        $secondsInactive = time() - $_SESSION['last_action'];
        $expireAfterSeconds = $expireAfter * 60;

        if ($secondsInactive >= $expireAfterSeconds) {
            header("LOCATION: index.php");
            session_destroy();
        }
    }

    $_SESSION['last_action'] = time();

    // CONNEXIÓ AMB TOTA LA PÀGINA
    include "codi_repetit/funcio_no_iniciat_sessio.php";
?>
