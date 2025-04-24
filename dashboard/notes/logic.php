<?php
    require __DIR__ . "/../../funcs/connessione.php";
    require __DIR__ . "/../../funcs/session.php";

    avviaSessioneProtetta(15 * 60);
    $userid = $_SESSION['uid'];


    //se vogliamo inserire una nota
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $titolo = $_POST["title"];
        $testo = $_POST["text"];
        $group = (int) $_POST["group"];
        $iv = $_POST["iv"];

        $smtp = $conn->prepare("INSERT INTO note(titolo, testo, gruppo, iv, userID) VALUES (?,?,?,?,?)");
        $smtp->bind_param("ssisi", $titolo, $testo,$group, $iv,$userid);
        $smtp->execute();
        echo "STATUS: OK";

        //se vogliamo prendere le note
    } else if ($_SERVER['REQUEST_METHOD' === 'GET']) {

        $sql = "SELECT id, titolo, testo, gruppo, iv FROM note WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userid);
        $stmt->execute();

        $result = $stmt->get_result();
        $notes = [];

        while ($row = $result->fetch_assoc()) {
            $notes[] = $row;
        }
    }
?>