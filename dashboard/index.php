<!DOCTYPE html>
<html lang="it" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veil - Dashboard</title>
    <link rel="manifest" href="../manifest.json">
    <script src="/funcs/js/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="/funcs/js/bootstrap.bundle.min.js"></script>
    <script src="/funcs/js/app.js"></script>
    <script src="/funcs/js/keyderiv.js"></script>
    <script src="/funcs/js/alert.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <?php
        require_once "../funcs/session.php";
        avviaSessioneProtetta(15 * 60); // 15 minuti di timeout
    ?>
    <script>
        var alertnum = 0
        var pubkey, privkey
        $( async () => {
            if (keyManager.hasKey()) {
                try {
                    ({ pubkey, privkey } = await keyManager.loadAndImportKeys());
                } catch (err) {
                    console.error("Errore durante il caricamento delle chiavi:", err);
                    location.replace("/funcs/logout.php");
                }
            }else {
                location.replace("/funcs/logout.php")
            }   

            $("#logoutbtn").on("click",function() {
                location.replace("/funcs/logout.php");
            })

                let response = await fetch("https://api.adviceslip.com/advice");
                let adviceData = await response.json();
                let advice = adviceData.slip.advice;
                $("#advtext").html(advice)
        })

    </script>
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">
    <div id="toastdiv" class="w-25 position-fixed bottom-0 start-0 p-3 pe-5 z-3">
    </div>
    <h2 class="py-4 px-5 pb-0 position-relative" style="min-height:6.8vh"><b>
        <?php
        echo "Bentornato {$_SESSION['username']}!";
        ?>
    </b>
    <button class="btn btn-outline-secondary btn-sm ms-2" id="logoutbtn">Logout</button>
    <b class="text-end position-absolute end-0 me-5 text-secondary h5 bottom-0" id="advtext"></b>
    </h2>

    <!-- Container with grid rows taking full remaining height -->
    <section class="container-fluid px-5 py-3" width="100vw">
        <div class="row">
            <!--Sezione di sinistra-->
            <div class="col-xl-8">
                <!-- First Row -->
                <div class="row" style="min-height: 41.9vh">
                    <section class="col-md-5 me-5 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 41.9vh">
                        <h4 class='ps-4 pt-4 evidtext'><b>Note</b></h4>
                        <?php require "notes/card.html"?>
                    </section>
                    <section class="col-md-6 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 41.9vh">
                        <h4 class='ps-4 pt-4 evidtext'><b>Calendario</b></h4>
                        <?php require "calendar/card.html"?>
                    </section>
                </div>
                <!-- Second Row -->
                <div class="row" style="min-height: 41.9vh">
                    <section class="col-md-6 me-5 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 41.9vh">
                        <h4 class='ps-4 pt-4 evidtext'><b>Task giornaliere</b></h4>
                        <?php require "dailytasks/card.html"?>
                    </section>
                    <section class="col-md-5 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 41.9vh">
                        <h4 class='ps-4 pt-4 evidtext'><b>Cloud storage cryptato</b></h4>
                        <?php require "filemanager/card.html"?>
                    </section>
                </div>
            </div>
            <!--Sezione di destra-->
            <div class="col-xl-4">
                <section class=" mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 83.8vh">
                    <h4 class='ps-4 pt-4 evidtext'><b>Messaggi privati</b></h4>
                    <?php require "msgs/card.html"?>
                </section>
            </div>
        </div>
    </section>
</body>
</html>