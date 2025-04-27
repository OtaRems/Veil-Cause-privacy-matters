<!DOCTYPE html>
<html lang="it" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veil - Dashboard</title>
    <link rel="manifest" href="../manifest.json">
    <script src="/funcs/js/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
        let key
        $( async () => {
            if (keyManager.hasKey()) {
                key = await keyManager.loadKey();
            }else {
                location.replace("/funcs/logout.php")
            }   

            $("#logoutbtn").on("click",function() {
                location.replace("/funcs/logout.php");
            })
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
    </h2>

    <!-- Container with grid rows taking full remaining height -->
    <section class="container-fluid px-5 py-3" width="100vw">
        <div class="row">
            <!--Sezione di sinistra-->
            <div class="col-8 m-0 p-0">
                <!-- First Row -->
                <div class="row" style="min-height: 41.9vh">
                    <section class="col-xl-5 me-5 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 41.9vh">
                        <?php require "notes/card.html"?>
                    </section>
                    <section class="col-xl-6 me-5 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 41.9vh">
                        <?php require "calendar/card.html"?>
                    </section>
                </div>
                <!-- Second Row -->
                <div class="row" style="min-height: 41.9vh">
                    <section class="col-xl-6 me-5 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 41.9vh">
                        <?php require "dailytasks/card.html"?>
                    </section>
                    <section class="col-xl-5 me-5 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 41.9vh">
                        <?php require "filemanager/card.html"?>
                    </section>
                </div>
            </div>
            <!--Sezione di destra-->
            <div class="col-4 m-0 p-0">
                <section class="me-5 mb-4 secbg rounded-5 shadow p-0 position-relative overflow-hidden" style="height: 83.8vh">
                <?php require "msgs/card.html"?>
                </section>
            </div>
        </div>
    </section>
</body>
</html>