<?php
require "../funcs/connessione.php";

// Permetti solo POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed");
}

// Ottieni i dati
$user    = $_POST["username"] ?? null;
$argon   = $_POST["pass"] ?? null;
$salt    = $_POST["salt"] ?? null;
$pubkey  = $_POST["pubkey"] ?? null;
$privkey = $_POST["privkey"] ?? null;
$iv      = $_POST["iv"] ?? null;

// Regex di sicurezza per username
$PatternUser = "/^[A-Za-z][A-Za-z0-9]{0,19}$/";
if (!$user || !$argon || !$salt || !$pubkey || !$privkey || !$iv || !preg_match($PatternUser, $user)) {
    http_response_code(400);
    exit("Invalid input");
}

// SHA-256 sul risultato di Argon2id
$finalHash = hash("sha256", $argon, false);

// Controlla se l'utente esiste
$check = $conn->prepare("SELECT 1 FROM utenti WHERE username = ?");
$check->bind_param("s", $user);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo 1; // Username già usato
    $check->close();
    exit;
}
$check->close();

// Inserisce l'utente
$stmt = $conn->prepare("INSERT INTO utenti (username, passhash, salt, publicKey, privateKey, iv) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    http_response_code(500);
    exit("Errore DB");
}

$stmt->bind_param("ssssss", $user, $finalHash, $salt, $pubkey, $privkey, $iv);
$success = $stmt->execute();
$stmt->close();

echo $success ? 0 : "Errore durante la registrazione";
?>
