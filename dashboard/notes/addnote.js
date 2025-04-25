function addNoteState() {
    $("#notecont").html(` 
        <h4 class='ps-4 pt-4 evidtext'><b>Note</b></h4>
        <form>
        <input type="text" name="titolo" id="titlenota" placeholder="Nuovo Titolo" class="form-control form-control-lg px-4" style="background:none;border:none; font-weight:bolder" maxlength="20" required>
        <div id="testonota" contenteditable="true" data-placeholder="Inserisci il testo della tua nota privata..." spellcheck="false" class="form-control px-4 overflow-scroll" style="height: 13rem;background:none;border:none;"></div>
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
    
    <!--Pulsante per salvare Note-->
    <button id="savenotebtn" class="roundbtn">🡩</button>
    
    
    ` )
    bindNoteEvents();
}

//funzioni per l'aggiunta di note
function bindNoteEvents() {
    function updateButtonStates() {
      $("[data-notecode]").each(function () {
        const cmd = $(this).data("notecode");
        const isActive = document.queryCommandState(cmd);
        $(this).toggleClass("active", isActive);
      });
    }

    $("button[data-notecode]").on("click", function (e) {
      e.preventDefault();
      const command = $(this).data("notecode");
      document.execCommand(command, false, null);
      updateButtonStates();
      $("#testonota").focus();
    });

    $("#testonota").on("keyup mouseup", function () {
      updateButtonStates();
      const el = $(this);
      if (el.html() === "<br>" || el.text().trim() === "") {
        el.empty();
      }
    });


    //seleziona il gruppo della nota
    $("#customSelect .dropdown-item").on("click", function (e) {
      e.preventDefault();
      const value = $(this).data("value");
      const label = $(this).text();
      const groupClass = $(this).attr("class").match(/notegroup-\d/);
      const $button = $("#customSelect button");

      $button.removeClass("notegroup-1 notegroup-2 notegroup-3 notegroup-4 notegroup-5");

      if (groupClass) {
        $button.addClass(groupClass[0]);
      }

      $("#realselect").val(value);
      $("#customSelect button").text(label);
    });

    //tasto per andare indietro
    $("#backnotebutton").on("click", function() {
      $.ajax({
        url:"notes/card.html",
        method: "GET",
        success:function(res) {
          $("#notecont").html(res);
        }
      })
    })

    //tasto per salvare la nota
    $("#savenotebtn").on("click", async function () {
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
            title: base64Title,
            text: base64Text,
            iv:base64IV,
            group:group
          },
          success: function(res) {
            console.log(res)
            let text = `<b>Stato:</b> Nota aggiunta con successo!`
            addAlert("success", text, alertId);

          }
      })

      } catch (error) {
        console.error("Errore durante la cifratura:", error);
      }

      //ritorno alla lista di note quando si finisce di caricare
      $.ajax({
        url:"note/card.html",
        method: "GET",
        success:function(res) {
          $("#notecont").html(res);
        }
      })
    });
  }