<!DOCTYPE html>
<html lang="it" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veil - Dashboard</title>
    <link rel="manifest" href="../manifest.json">
    <script src="../js/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/app.js"></script>
    <script src="/js/keyderiv.js"></script>
    <script src="/js/alert.js"></script>
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
        })
        
    </script>
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">
    <div id="toastdiv" class="w-25 position-fixed bottom-0 start-0 p-3 pe-5 z-3">
    </div>
    <h2 class="py-4 px-5 pb-0" style="height:6.8vh"><b>
        <?php
        echo "Bentornato {$_SESSION['username']}!";
        ?>
    </b></h2>

    <!-- Container with grid rows taking full remaining height -->
    <section class="container-fluid px-5 py-3 flex-grow-1 d-flex flex-column justify-content-between">
        <!-- First Row -->
        <div class="row mb-4" style="height: 41.9vh">
            <section class="col-xl-3 col-md-6 secbg rounded-5 shadow me-5 p-0 position-relative overflow-hidden h-100">
                <?php require "notes/card.html"?>
            </section>
        </div>
        <!-- Second Row -->
        <div class="row mb-4" style="height:41.9vh">
            <section class="col-4 secbg rounded-5 shadow me-5"></section>
            <section class="col-5 secbg rounded-5 shadow"></section>
        </div>
    </section>
</body>
</html>