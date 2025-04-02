<?php
$user = $_POST["username"];
$pass = $_POST["pass"];
$salt = $_POST["salt"];

$shapass = hash("sha256", $pass, false);
echo "ciao {$user}, la tua pass è {$pass}<br>il salt usato è {$salt}";
?>