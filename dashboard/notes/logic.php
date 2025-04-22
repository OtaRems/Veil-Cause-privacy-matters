<?php
    require "/funcs/connessione.php";

    $smtp = $conn->prepare("INSERT INTO note(username,passhash,salt) VALUES (?,?,?)");
    $smtp->bind_param("sss", $user, $passhash,$salt);
    $smtp->execute();
?>