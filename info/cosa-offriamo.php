<!DOCTYPE html>
<html lang="it" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veil - Cause privacy matters</title>
    <script src="/funcs/js/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="/funcs/js/bootstrap.bundle.min.js"></script>
    <script src="/funcs/js/three.min.js.js"></script>
    <script src="/funcs/js/vanta.net.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
</head>
<body>
    <header id="mainHeader" class="fixed-top" style="background: linear-gradient(180deg, #00000055 0%, #00000000 90%);">
        <div class="container d-flex justify-content-between align-items-center p-4 " style="height:6rem; transition: all 0.5s ease">
            <div class="h-100 d-flex align-items-center gap-2 logo-container position-relative">
              <img src="/img/Logogreen.png" alt="" style="height: 3rem">
              <span class="fw-bold fs-4 ms-1">Veil</span>
              <a href="/" class="stretched-link"></a>
            </div>
            <nav id="mainnav" class="navbar">
              <a href="#" class="mx-2 text-decoration-none nav-link" tabindex="-1">Cosa offriamo</a>
              <a href="/info/motivo-progetto" class="mx-2 text-decoration-none nav-link" tabindex="-1">Il motivo del progetto</a>
              <a href="/info/sviluppo" class="mx-2 text-decoration-none nav-link" tabindex="-1">Come è sviluppato Veil</a>  
              <a href="/info/come-proteggersi" class="mx-2 text-decoration-none nav-link" tabindex="-1">Come proteggere la propria privacy</a>
            </nav>
        </div>
    </header>
    <!--Landing-->
    <main style="height:170vh" class="d-flex justify-content-center align-items-center">  
      <section class="container position-absolute secbg rounded-4 p-5" style="top: 15%;">
          <a href="/index.html" id="backbutton" class="btn btn-outline-secondary btn-sm rounded-circle position-absolute top-0 end-0 mt-4 me-4">🡨</a>
          <div class="row mb-5">
            <div class="col-lg-7 p-5">
              <h2 class="fs-1 fw-bolder">Cos'è Veil</h2>
              <p class="pe-4">
                <span class="fw-semibold">Veil</span> è una piattaforma cloud <span class="text-decoration-underline">pensata per utenti che mettono la privacy al centro</span>. A differenza delle comuni app per la produttività,
                <span class="text-success-emphasis fw-semibold">Veil non raccoglie, analizza né vende i tuoi dati: ciò che fai rimane soltanto tuo.</span><br><br>
                Tutto – dalle note ai task, dai file alle attività – viene crittografato direttamente nel tuo browser <b>prima</b> di essere inviato. Nessun server, nemmeno Veil stesso, può accedere ai tuoi contenuti. 
                La tua password non lascia mai il dispositivo, fungendo da <b>chiave principale</b> per il tuo mondo privato.<br><br>
                L'interfaccia è progettata per essere pulita, essenziale e intuitiva. Tra le funzionalità attualmente integrate:
              </p>
              <ul class="list-group list-group-flush ps-3">
                <li class="list-group-item">📝 Note private cifrate <span class="badge text-bg-danger">Completo!</span></li>
                <li class="list-group-item">📅 Calendario personale sicuro</li>
                <li class="list-group-item">✅ Task manager giornaliero</li>
                <li class="list-group-item">🔐 Condivisione sicura di file e messaggi</li>
                <li class="list-group-item">🧨 Wipe d’emergenza per eliminazione totale dei dati</li>
              </ul>
            </div>
            <div class="col-lg-5 p-5">
              <h2 class="fs-1 fw-bolder">Aggiornamenti</h2>
              <p class="pe-4">
                <span class="text-success-emphasis fw-semibold">Veil è in costante evoluzione</span>, con l’aggiunta regolare di nuove funzioni e metodi avanzati per rafforzare la sicurezza, sia lato client che lato server.<br><br>
                La nostra <b>unica priorità sei tu</b>: nessuna pubblicità, nessun tracciamento, nessun compromesso.<br><br>
                <span class="text-danger fw-semibold">Promettiamo di non salvare né vendere mai alcuna tua informazione personale</span>. Non per politica, ma per architettura: l’unico dato che conosciamo è il tuo username. Tutto il resto ci arriva in forma cifrata o hashata. Solo tu puoi decifrare, solo tu sai come accedere.
              </p>
            </div>
          </div>
        
          <h2 class="fs-1 fw-bolder text-center mb-4">Filosofia del progetto</h2>
          <div class="row gx-4 gy-4 justify-content-center">
            <div class="col-md-6 col-xl-3">
              <div class="card border-0 shadow-lg rounded-4 h-100 p-3">
                <div class="card-body">
                  <h5 class="card-title"><b>Zero dipendenze da Big Tech</b></h5>
                  <p class="card-text">Veil non utilizza API o librerie di Google, Meta, Amazon o altri soggetti noti per pratiche invasive. Nessun collegamento a infrastrutture esterne non verificabili.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card border-0 shadow-lg rounded-4 h-100 p-3">
                <div class="card-body">
                  <h5 class="card-title"><b>Zero-Knowledge Architecture</b></h5>
                  <p class="card-text">I tuoi dati sono crittografati prima di lasciare il tuo dispositivo. Nessuno, nemmeno gli sviluppatori o il server stesso, può accedere al contenuto originale.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card border-0 shadow-lg rounded-4 h-100 p-3">
                <div class="card-body">
                  <h5 class="card-title"><b>Privacy reale, non solo promessa</b></h5>
                  <p class="card-text">
                    Nessun tracciamento, cookie, analytics o log lato server.<br>
                    Veil:<ul>
                      <li>non raccoglie comportamenti d’uso</li>
                      <li>non conserva metadati identificabili</li>
                      <li>non integra servizi esterni</li>
                    </ul>
                    Il server riceve solo ciò che serve: hash, blob cifrati e username.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card border-0 shadow-lg rounded-4 h-100 p-3">
                <div class="card-body">
                  <h5 class="card-title"><b>Codice open-source e verificabile</b></h5>
                  <p class="card-text">La fiducia non si chiede: si conquista.<br>Veil è interamente open-source. Chiunque può verificare che fa davvero ciò che promette. Niente black-box: se vuoi, puoi persino ricompilarlo da zero.</p>
                </div>
              </div>
            </div>
          </div>
      </section>
    </main>
</body>
<script>
 $(window).on("scroll", function () {
    if ($(this).scrollTop() > 100) {
      $("#mainHeader").addClass("shrunk");
    } else {
      $("#mainHeader").removeClass("shrunk");
    }
  });
</script>
</html>