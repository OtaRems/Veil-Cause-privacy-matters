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
              <a href="#" class="mx-2 text-decoration-none nav-link" tabindex="-1">Il motivo del progetto</a>
              <a href="/info/sviluppo" class="mx-2 text-decoration-none nav-link" tabindex="-1">Come è sviluppato Veil</a>  
              <a href="/info/come-proteggersi" class="mx-2 text-decoration-none nav-link" tabindex="-1">Come proteggere la propria privacy</a>
            </nav>
        </div>
    </header>
    <!--Landing-->
    <main style="height:150vh" class="d-flex justify-content-center align-items-center">  
      <section class="container position-absolute secbg rounded-4 p-5" style="top: 15%;">
          <a href="/index.html" id="backbutton" class="btn btn-outline-secondary btn-sm rounded-circle position-absolute top-0 end-0 mt-4 me-4">🡨</a>
          <div class="row">
            <div class="col-6 p-5">
               <h2 class="fs-1 fw-bolder mb-4">Il motivo del progetto</h2>
               <p class="pe-5">
                 Noi e altri milioni di persone <strong class="text-success-emphasis">consideriamo la privacy un diritto inviolabile</strong> di ogni singolo individuo, un diritto che purtroppo, oggi, stiamo perdendo.
                 <br><br>
                 Con l'avanzare dell'era digitale e l'uso sempre più intenso di internet, siamo diventati dipendenti dai servizi online: passiamo ore sui social, a fare ricerche, a comunicare, a vivere attraverso i dispositivi. Ma ogni volta che lo facciamo, <span class="text-danger fw-semibold">regaliamo i nostri dati</span> a gigantesche aziende tecnologiche, che li vendono a pubblicitari, broker di dati e altri attori senza scrupoli. 
                 <br>
                 <span class="text-secondary fst-italic">La verità è che non siamo i clienti, siamo il prodotto.</span>
               </p>

               <ol class=" pe-4 list-group">
                 <li class="mt-5 mb-4">
                   <strong class="fs-5">Vendita dei dati per manipolarti meglio.</strong><br>
                   I tuoi dati vengono venduti per mostrarti pubblicità su misura, pensate per farti desiderare cose che non ti servono. Quante volte ti è capitato di parlare di una vacanza e poco dopo vedere pubblicità di voli o hotel? Non è magia: è sorveglianza.
                   Gli assistenti vocali sono sempre in ascolto. E non è paranoia: se rispondono a “Hey Siri” o “Hey Google”, significa che ti stanno già ascoltando.
                 </li>

                 <li class="mb-4">
                   <strong class="fs-5">Email e numero di telefono? Moneta per lo spam.</strong><br>
                   Ogni volta che ti registri da qualche parte, consegni i tuoi contatti a un mercato invisibile. Risultato? Caselle piene di spam, telefonate indesiderate, pubblicità ovunque. E spesso non sai nemmeno da dove arrivano.
                 </li>

                 <li class="mb-2">
                   <strong class="text-danger fs-5">Controllo delle masse. Il fine ultimo.</strong><br>
                   I poteri forti non usano più soldati: oggi usano gli <em>schermi</em>. Social network, influencer, pubblicità e news non servono solo a vendere, ma a <span class="text-decoration-underline">plasmare ciò che pensi</span>. Ogni contenuto che vedi, ogni video che ti viene proposto, ogni like che lasci, è parte di una <strong>strategia invisibile</strong> per trasformarti in un consumatore prevedibile e un cittadino docile.
                   <br><br>
                   <span class="text-muted fst-italic">
                     Non sei libero: sei guidato. Non sei solo un utente: sei un bersaglio. 
                     E se pensi: “non ho nulla da nascondere”, sei già esattamente ciò che vogliono tu sia.
                   </span>
                 </li>
               </ol>
            </div>
            <div class="col-6 p-5">
            <h2 class="fs-1 fw-bolder">Cos'è la privacy</h2>
            <p class="pe-5">La privacy è un concetto che esiste da secoli, ma l'avvento di internet e dei social media ha avuto un impatto significativo sul suo significato. Privacy significa essere soli e non essere osservati o interrotti dagli altri. Tuttavia, nell'era digitale di oggi, questa definizione si è evoluta fino a comprendere la protezione dei dati personali e la prevenzione del tracciamento senza esplicito consenso.<br><br>Quando vai online, lasci impronte digitali utilizzate da varie entità per tracciare il tuo comportamento, monitorare la tua attività e raccogliere i tuoi dati. Questa intrusione nella tua vita online può farti sentire esposto e vulnerabile. Indipendentemente dal fatto che tu sia solo quando navighi su internet, qualcuno sta guardando e costruendo il tuo profilo comportamentale online.</p>
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