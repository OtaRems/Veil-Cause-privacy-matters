<?php
    require __DIR__ . "/../../funcs/connessione.php";
    require __DIR__ . "/../../funcs/session.php";

    avviaSessioneProtetta(15 * 60);
    $userid = (int) $_SESSION['uid'];


    //se vogliamo inserire una nota
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["request"] == "add") {
        $titolo = $_POST["title"];
        $testo = $_POST["text"];
        $group = (int) $_POST["group"];
        $iv = $_POST["iv"];
        $encryptedKey = $_POST["encryptedKey"];
        $lastedited = date('Y-m-d H:i:s');
    
        $smtp = $conn->prepare("INSERT INTO note (titolo, testo, gruppo, iv, notekey, userID, lastEdited) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $smtp->bind_param("ssissis", $titolo, $testo, $group, $iv, $encryptedKey, $userid, $lastedited);
        $smtp->execute();
        echo "STATUS: OK";
    
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["request"] == "edit") {
        $idnota = $_POST["id"];
        $titolo = $_POST["title"];
        $testo = $_POST["text"];
        $group = (int) $_POST["group"];
        $iv = $_POST["iv"];
        $encryptedKey = $_POST["encryptedKey"];
        $lastedited = date('Y-m-d H:i:s');
    
        $smtp = $conn->prepare("UPDATE note SET titolo = ?, testo = ?, gruppo = ?, iv = ?, notekey = ?, lastEdited = ? WHERE IDNota = ?");
        $smtp->bind_param("ssissssi", $titolo, $testo, $group, $iv, $encryptedKey, $lastedited, $idnota);
    
        if ($smtp->execute())
            echo "STATUS: OK";
        else
            echo "STATUS: NOT OK";    
    
    //se vogliamo eliminare una nota
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["request"] == "delete") {
        $idnota = $_POST["id"];

        $smtp = $conn->prepare("DELETE FROM note WHERE IDNota = ?");
        $smtp->bind_param("i", $idnota);
        if ($smtp->execute())
            echo "STATUS: OK";
        else
            echo "STATUS: NOT OK";

    //se vogliamo prendere le note
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        header('Content-Type: application/json');

        $sql = "SELECT IDNota, titolo, testo, gruppo, iv, lastEdited FROM note WHERE userID = ? ORDER BY lastEdited desc";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userid);
        $stmt->execute();

        $result = $stmt->get_result();
        $notes = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($notes);
    }
?>