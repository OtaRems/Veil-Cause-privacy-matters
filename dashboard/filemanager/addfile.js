function addfileState() {
    $("#filecont").html(` 
        <form>
        <div class="btn-toolbar px-4 mt-3">
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

  let formcontrol = $("#titlenota");
  //animazione per quando si supera il numero di caratteri in un input
  formcontrol.on("keydown paste", function (e) {
    if (this.value.length >= this.maxLength) {
      // Allow control keys like Backspace, Delete, Arrows
      const allowedKeys = ["Backspace", "Delete", "ArrowLeft", "ArrowRight", "ArrowUp", "ArrowDown"];
      
      if (e.type === "paste" || !allowedKeys.includes(e.key)) {
        triggerAnimation(this);
        e.preventDefault(); // prevent pasting or typing extra
      }
    }
  });
  
  function triggerAnimation(element) {
    element.classList.add("shake-animation");
  
    element.addEventListener("animationend", function handler() {
      element.classList.remove("shake-animation");
      element.removeEventListener("animationend", handler);
    });
  }


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
            group:group,
            request: "add"
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
        url:"notes/card.html",
        method: "GET",
        success:function(res) {
          $("#notecont").html(res);
        }
      })
    });
  }