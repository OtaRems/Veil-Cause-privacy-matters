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
              <a href="/info/cosa-offriamo" class="mx-2 text-decoration-none nav-link" tabindex="-1">Cosa offriamo</a>
              <a href="/info/motivo-progetto" class="mx-2 text-decoration-none nav-link" tabindex="-1">Il motivo del progetto</a>
              <a href="#" class="mx-2 text-decoration-none nav-link" tabindex="-1">Come è sviluppato Veil</a>  
              <a href="/info/come-proteggersi" class="mx-2 text-decoration-none nav-link" tabindex="-1">Come proteggere la propria privacy</a>
            </nav>
        </div>
    </header>
    <!--Landing-->
    <main style="height:170vh" class="d-flex justify-content-center align-items-center">  
      <section class="container position-absolute secbg rounded-4 p-5" style="top: 15%;">
          <a href="/index.html" id="backbutton" class="btn btn-outline-secondary btn-sm rounded-circle position-absolute top-0 end-0 mt-4 me-4">🡨</a>
          <div class="row">
            <div class="col p-5">
  <h2 class="fs-1 fw-bolder mb-4">Come è sviluppato</h2>
  <p class=" pe-5">
    Questo progetto nasce con un obiettivo preciso: <strong>proteggere la tua privacy e il tuo anonimato</strong> fin dalle fondamenta. Ogni riga di codice, ogni scelta tecnica, ogni libreria adottata è stata valutata con un solo principio guida: <span class="text-decoration-underline">l’utente al centro, i suoi dati sotto chiave, e nessun compromesso con il tracciamento o la sorveglianza.</spa>
  </p>
    <hr>
  <ul class=" pe-5">
    <li class="mb-3">
      <strong>Crittografia lato client</strong>: Ogni singolo dato viene <strong>crittografato nel tuo dispositivo</strong> prima di essere salvato. Nessun dato leggibile lascia il tuo browser. Usiamo algoritmi robusti come <code>AES</code>, <code>RSA</code> e tecniche di derivazione sicura come <code>Argon2id</code>.
    </li>
    <hr>
    <li class="mb-3">
      <strong>Autenticazione Zero-Knowledge</strong>: Durante il login, la tua password <strong>non lascia mai il tuo dispositivo</strong>, e quindi non viene mai salvata sul server. Usiamo un meccanismo a due fasi basato sulla <code>Crittografia asimmetrica</code> per verificare l’identità senza mai conoscere la tua chiave reale.
      <br>
      Abbiamo modificato l'algoritmo di generazione delle chiavi <code>RSA</code>, facendo in modo che il seme da cui partono tutte le generazioni casuali venga creato a partire dalla password, così da fare in modo che ad ogni coppia di chiavi equivalga una singola password. Con questa coppia possiamo utilizzare un sistema <code>Challenge-Response</code> in cui la chiave pubblica viene salvata sul server, mentre la privata resta esclusivamente sul dispositivo dell’utente, mai trasmessa. Al momento del login, il server genera una stringa casuale (una challenge) e la cifra con la chiave pubblica. Il client, ricostruendo la chiave privata dalla password, è in grado di decifrarla. Se il messaggio decifrato corrisponde, l’identità è confermata. <br><br>
    <em>È una vera e propria prova di possesso della chiave privata</em>, senza mai mostrarla o trasmetterla: nessuno – nemmeno il server – può mai sapere la tua password o derivarne la chiave. È un sistema “Zero-Knowledge” nel senso più autentico del termine.
    <br><br>
    Tutto ciò nasce da una convinzione: <strong>nessun elemento dell’infrastruttura – né il server, né il client, né la rete – può essere ritenuto completamente sicuro</strong>. Per questo il sistema è costruito in modo che nemmeno un’intercettazione totale dei flussi permetta di accedere ai dati o alle credenziali.
      <br>
      Tutto questo perché noi di Veil reputiamo di importanza vitale il fatto che nulla su internet sia sicuro, e che quindi ne il server, ne il client e soprattutto il canale (anche se usa <code>HTTPS</code>) siano sicuri.
      <br>
      <span class="text-secondary">Prima utilizzavamo un sistema di doppio hash in cui sulla password inserita dall'utente veniva prima utilizzato un algoritmo come Argon2ID, poi il digest generato veniva inviato di sul server, che quindi non vedeva mai la password, ma solo una stringa derivata ed irreversibile. Sul server veniva applicato un altro algorito di hashing, per proteggere la password da attacchi <code>Pass-The-Hash</code> in caso di leak del server. <br> Quindi con questa metodologia proteggiamo il client dal server, che non vedrà mai la password, però purtroppo dimentichiamo che questo digest deve passare comunque per il canale meno sicuro che possa esserci: "L'internet", che nonostante usi tecniche come l'https non possiamo reputare sicuro, e che quindi un malintenzionato in possesso di questo primo digest potrebbe tranquillamente passarlo al server per accedere ad un account.</span>
    </li>

<hr>
    <li class="mb-3">
      <strong>Comunicazione sicura</strong>: Ogni comunicazione è protetta da una doppia crittografia: Per prima, quella applicata da Veil, e poi come protezione aggiuntiva c'è l'HTTPS. Anche  se ci fosse quest'ultimo, i tuoi dati resterebbero illeggibili. Perché <em>la vera sicurezza sta nella crittografia, non nel trasporto.</em>
    </li>
<hr>

    <li class="mb-3">
      <strong>100% open source</strong>: Il codice è pubblico, trasparente e verificabile da chiunque. Nessun comportamento nascosto, nessuna porta sul retro. La fiducia non va chiesta: va meritata.
    </li>
<hr>
    <li class="mb-3">
      <strong>Sviluppato con linguaggi semplici ma potenti</strong>: HTML5, CSS3, JavaScript puro, PHP moderno. Nessun framework pesante, nessun tracking di terze parti. Solo ciò che serve, costruito con cura e pulizia.
    </li>
<hr>
  </ul>

  <p class=" pe-5 mt-4">
    Se vuoi contribuire, studiare il codice o semplicemente verificarlo, trovi tutto qui:
  </p>

  <a href="https://github.com/OtaRems/Veil-Cause-privacy-matters.git" target="_blank" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
    Vai al progetto su GitHub →
  </a>
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