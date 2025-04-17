<?php
require "/funcs/connessione.php";

$user = $_POST["username"];
$pass = $_POST["pass"];
$salt = $_POST["salt"];

$PatternUser = "/^[A-Za-z][A-Za-z0-9]{0,19}$/";

if (!preg_match($PatternUser, $user)) {
    // Log the error (do not expose details to the client)
    die("Invalid input");
}

$smtp = $conn->prepare("SELECT * FROM utenti WHERE username = ?");
$smtp->bind_param("s", $user);
$smtp->execute();
$result = $smtp->get_result();



if ($result->num_rows == 0) {
    $passhash = hash("sha256", $pass, false);
    $smtp = $conn->prepare("INSERT INTO utenti(username,passhash,salt) VALUES (?,?,?)");
    $smtp->bind_param("sss", $user, $passhash,$salt);
    $smtp->execute();
    echo 0;
}
else {
    echo 1;
}

$smtp->close();
?>