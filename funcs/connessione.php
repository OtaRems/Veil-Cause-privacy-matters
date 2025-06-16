<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Veil";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error)
        die("connessione al database fallita". $conn->connect_error);

?>