<?php
require "../connessione.php";

if (isset($_POST["username"])) {
    $username = $_POST["username"];

    if (isset($_POST["hashpass"])) {
        // Abbiamo ricevuto username e hash della password
        $hashClient = $_POST["hashpass"];
        $hashFinale = hash("sha256", $hashClient, false); // ulteriore hash lato server

        // Prepariamo la query per recuperare l'utente
        $stmt = $conn->prepare("SELECT passhash FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $risultato = $stmt->get_result();

        if ($risultato->num_rows > 0) {
            $dati = $risultato->fetch_assoc();
            if (hash_equals($dati["passhash"], $hashFinale)) {
                echo "LOGIN_OK";
            } else {
                echo "LOGIN_FAILED";
            }
        } else {
            echo "USER_NOT_FOUND";
        }

    } else {
        // Richiesta del salt associato all'utente
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
