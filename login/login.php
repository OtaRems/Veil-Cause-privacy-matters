<?php
require "/funcs/connessione.php";

// Sicurezza per il cookie di sessione
session_set_cookie_params([
    'lifetime' => 0, // Scade alla chiusura del browser
    'path' => '/',
    'domain' => null,
    'secure' => true, // Usa solo HTTPS
    'httponly' => true, // Il cookie non è accessibile da JavaScript
    'samesite' => 'Strict' // Protezione da CSRF
]);

session_start();

if (isset($_POST["username"])) {
    $username = $_POST["username"];

    if (isset($_POST["hashpass"])) {
        // SECONDA RICHIESTA - Verifica credenziali
        $hashClient = $_POST["hashpass"];
        $hashFinale = hash("sha256", $hashClient, false);

        $stmt = $conn->prepare("SELECT UID, passhash FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $risultato = $stmt->get_result();

        if ($risultato->num_rows > 0) {
            $dati = $risultato->fetch_assoc();
            if (hash_equals($dati["passhash"], $hashFinale)) {
                // Login riuscito, rigeneriamo ID di sessione
                session_regenerate_id(true);
                $_SESSION["username"] = $username; // inizializza username
                $_SESSION["uid"] = $dati["UID"]; // inizializza username
                $_SESSION["last_activity"] = time(); // inizializza il timer inattività
                echo "LOGIN_OK";
            } else {
                echo "LOGIN_FAILED";
            }
        } else {
            echo "USER_NOT_FOUND";
        }

    } else {
        // PRIMA RICHIESTA - Invio del salt
        $patternUsername = "/^[A-Za-z][A-Za-z0-9]{0,19}$/";

        if (!preg_match($patternUsername, $username)) {
            die("Input non valido");
        }

        $stmt = $conn->prepare("SELECT salt FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $risultato = $stmt->get_result();

        if ($risultato->num_rows > 0) {
            $dati = $risultato->fetch_assoc();
            echo $dati["salt"];
        } else {
            echo "USER_NOT_FOUND";
        }
    }
}
?>
