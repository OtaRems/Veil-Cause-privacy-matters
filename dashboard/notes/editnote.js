async function editNoteState(notaSelez) {

    const iv = Uint8Array.from(atob(notaSelez.iv), c => c.charCodeAt(0));
    const titoloBuffer = Uint8Array.from(atob(notaSelez.titolo), c => c.charCodeAt(0));
    const testoBuffer = Uint8Array.from(atob(notaSelez.testo), c => c.charCodeAt(0));

    const titoloDecrypted = await crypto.subtle.decrypt(
      { name: "AES-GCM", iv },
      key,
      titoloBuffer
    );

    const testoDecrypted = await crypto.subtle.decrypt(
      { name: "AES-GCM", iv },
      key,
      testoBuffer
    );

    const decoder = new TextDecoder();
    const titolo = decoder.decode(titoloDecrypted);
    const testo = decoder.decode(testoDecrypted);

    $("#notecont").html(` 
        <h4 class='ps-4 pt-4 evidtext'><b>Note</b></h4>
        <form data-idnota="${notaSelez.IDNota}">
        <input type="text" name="titolo" id="titlenota" placeholder="Nuovo Titolo" class="form-control form-control-lg px-4" style="background:none;border:none; font-weight:bolder" maxlength="20" required value="${titolo}">
        <div id="testonota" contenteditable="true" data-placeholder="Inserisci il testo della tua nota privata..." spellcheck="false" class="form-control px-4 overflow-scroll" style="height: 13rem;background:none;border:none;">${testo}</div>
        <div class="btn-toolbar px-4 mt-3">
          <button type="button" class="btn btn-sm btn-outline-secondary me-1" data-notecode="bold"><b>B</b></button>
          <button type="button" class="btn btn-sm btn-outline-secondary me-1" data-notecode="italic"><i>It</i></button>
          <button type="button" class="btn btn-sm btn-outline-secondary me-1" data-notecode="underline"><u>U</u></button>
          <button type="button" class="btn btn-sm btn-outline-secondary me-1" data-notecode="insertUnorderedList"><svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512"><path fill="#bbb" d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"/></svg></button>
          <div class="col-3 pe-3">
            <select class="form-select form-select-sm d-none" aria-label="Group-select" id="realselect">
              <option value="0" selected>G</option>
              <option value="1">g1</option>
              <option value="2">g2</option>
              <option value="3">g3</option>
              <option value="4">g4</option>
              <option value="5">g5</option>
            </select>
            <div id="customSelect" class="dropdown">
              <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">group</button>
              <ul class="dropdown-menu" style="--bs-dropdown-min-width: 6rem;">
                <li><a class="dropdown-item notegroup-1" href="#" data-value="1">⬤</a></li>
                <li><a class="dropdown-item notegroup-2" href="#" data-value="2">⬤</a></li>
                <li><a class="dropdown-item notegroup-3" href="#" data-value="3">⬤</a></li>
                <li><a class="dropdown-item notegroup-4" href="#" data-value="4">⬤</a></li>
                <li><a class="dropdown-item notegroup-5" href="#" data-value="5">⬤</a></li>
                <li><a class="dropdown-item notegroup-0" href="#" data-value="0">group</a></li>
              </ul>
            </div>
          </div>
          
        </div>
    </form>
    
    <!--Pulsante indietro-->
    <button id="backnotebutton" class="btn btn-outline-secondary btn-sm rounded-circle position-absolute top-0 end-0 mt-4 me-4">🡨</button>
    
    <!--Pulsante delete-->
    <button id="deletenotebutton" class="btn btn-outline-secondary btn-sm rounded-circle position-absolute top-0 end-0 mt-4" style="margin-right:5.5rem"><svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" fill="currentColor" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>

    <!--Pulsante per salvare Note-->
    <button id="editnotebutton" class="roundbtn">🡩</button>
    
    
    ` )

    //Settiamo il gruppo della nota
    let btn = $("#customSelect button");
    let labclass = `notegroup-${notaSelez.gruppo}`
    let texto = $(`.${labclass}`).text()
    if (notaSelez.gruppo != 0) {
      btn.addClass(labclass);
    }

    $("#realselect").val(notaSelez.gruppo);
    $("#customSelect button").text(texto);


    //funzioni per modificare la nota (addnote.js)
    bindNoteEvents()

    //funzione per eliminare la nota
    let delfirstclick = false;
    $("#deletenotebutton").on("click", function () {
      if (!delfirstclick) {
        delfirstclick = true
        $(this).removeClass("btn-outline-secondary").addClass("btn-danger");

        setTimeout (function() {
          delfirstclick = false;
          $("#deletenotebutton").removeClass("btn-danger").addClass("btn-outline-secondary");
        }, 2000)

      } else {
        var notaid = $("#notecont form").data("idnota")
        alertnum++
        const alertId = `alertnote-${alertnum}`;
        $.ajax({
          url:"notes/logic.php",
          method: "POST",
          data: {
            id: notaid,
            request: "delete"
          },
          success: function(res) {
            console.log(res)
            let text = `<b>Stato:</b> Nota eliminata con successo!`
            addAlert("success", text, alertId);

          }
        })

        $.ajax({
          url:"notes/card.html",
          method: "GET",
          success:function(res) {
            $("#notecont").html(res);
          }
        })
      }
    })

    $("#editnotebutton").on("click", async function () {
        var notaid = $("#notecont form").data("idnota")
        var titoloPlain = $("#titlenota").val()
        titoloPlain = titoloPlain.trim()
        const testoPlain = $("#testonota").html();
        const group = $("#realselect").val();
  
        alertnum++
        const alertId = `alertnote-${alertnum}`;
  
        titoloPlain = titoloPlain === "" ? "Nuova nota" : titoloPlain;
        if (testoPlain.trim() === "") {
            let text = `<b>Errore</b>: Non puoi inserire una nota vuota!`
            addAlert("danger",text,alertId)
          return;
        }
  
  
        const encoder = new TextEncoder();
        const titoloData = encoder.encode(titoloPlain);
        const testoData = encoder.encode(testoPlain);
  
        const iv = crypto.getRandomValues(new Uint8Array(12)); // IV per AES-GCM
  
        try {
          const cryptTitle = await crypto.subtle.encrypt(
            { name: "AES-GCM", iv },
            key,
            titoloData
          );
  
          const cryptText = await crypto.subtle.encrypt(
            { name: "AES-GCM", iv },
            key,
            testoData
          );
  
          // Convertiamo in Base64 per inviare via AJAX
          const base64Title = btoa(String.fromCharCode(...new Uint8Array(cryptTitle)));
          const base64Text = btoa(String.fromCharCode(...new Uint8Array(cryptText)));
          const base64IV = btoa(String.fromCharCode(...iv));
  
          $.ajax({
            url:"notes/logic.php",
            method: "POST",
            data: {
              id: notaid,
              title: base64Title,
              text: base64Text,
              iv:base64IV,
              group:group,
              request: "edit"
            },
            success: function(res) {
              console.log(res)
              let text = `<b>Stato:</b> Nota modificata con successo!`
              addAlert("success", text, alertId);
  
            }
        })
  
        } catch (error) {
          console.error("Errore durante la cifratura:", error);
        }
  
        //ritorno alla lista di note quando si finisce di caricare
        $.ajax({
          url:"notes/card.html",
          method: "GET",
          success:function(res) {
            $("#notecont").html(res);
          }
        })
      });
}