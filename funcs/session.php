<?php
function avviaSessioneProtetta($timeoutInSecondi = 900) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => null,
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    session_start();

    // Timeout gestione inattività
    if (isset($_SESSION["last_activity"])) {
        $inattivo = time() - $_SESSION["last_activity"];
        if ($inattivo > $timeoutInSecondi) {
            session_unset();
            session_destroy();
            header("Location: ../login/?expired=1");
            exit();
        }
    }

    // Aggiorna il tempo di attività
    $_SESSION["last_activity"] = time();

    // Controllo se l'utente è loggato
    if (!isset($_SESSION["username"])) {
        header("Location: /login/");
        exit();
    }
}
?>
