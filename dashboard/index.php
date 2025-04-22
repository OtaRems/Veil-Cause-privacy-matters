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
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <?php
        require_once "../funcs/session.php";
        avviaSessioneProtetta(15 * 60); // 15 minuti di timeout
    ?>
    <script>
        const key = keyManager.loadKey();
    </script>
</head>
<body class="d-flex flex-column" style="height: 100vh;">
    <h2 class="py-4 px-5 pb-0"><b>
        <?php
        echo "Bentornato {$_SESSION['username']}!";
        ?>
    </b></h2>

    <!-- Container with grid rows taking full remaining height -->
    <section class="container-fluid px-5 py-3 flex-grow-1 d-flex flex-column justify-content-between">
        <!-- First Row -->
        <div class="row h-50 mb-4">
            <section class="col-3 secbg rounded-5 shadow me-5 p-0 position-relative overflow-hidden h-100">
                <?php require "notes/card.php"?>
            </section>
            <section class="col-3 secbg rounded-5 shadow me-5 p-0 position-relative overflow-hidden h-100">
                <h4 class='ps-4 pt-4 evidtext'><b>Note</b></h4>
                <form>
                    <input type="text" name="titolo" id="titlenota" placeholder='Nuovo Titolo' class="form-control form-control-lg px-4" style="background:none;border:none; font-weight:bolder" maxlength="20">
                    <textarea name="testo" id="testonota" class="form-control px-4" rows="7" style="background:none;border:none;resize:none" placeholder="Inserisci il testo della tua nota privata..." ></textarea>
                </form>
                <button id="addnotebtn" class="roundbtn">+</button>
            </section>
        </div>
    <!-- Second Row -->
        <div class="row h-50 mb-3">
            <section class="col-4 secbg rounded-5 shadow me-5"></section>
            <section class="col-5 secbg rounded-5 shadow"></section>
        </div>
    </section>
    <div id="fullblur" class="position-fixed start-0 end-0 top-0 bottom-0 justify-content-center align-items-center d-flex d-none">
        <div class="content h-50 w-50 secbg rounded-4 position-relative">
            <button id="fullbtn" type="button" class="btn-close position-absolute end-0 top-0 p-4" aria-label="Close"></button>
            <div id="mainstuffcont"></div>
        </div>
    </div>
    <script>
        $("#fullbtn").on("click", function() {
            $("#mainstuffcont").html("")
            $("#fullblur").addClass("d-none");
        })
    </script>
</body>
</html>