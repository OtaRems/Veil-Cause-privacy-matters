function addFileState() {
    $("#filecont").html(` 
      <form class="px-4 pe-5">
        <label for="fileInput" class="mt-4">Seleziona il file che vuoi inserire</label>
        <input type="file" id="fileInput" class="form-control w-75"></input>

        <div class="btn-toolbar mt-3">
          <div class="col-3 pe-3">
            <select class="form-select form-select-sm d-none" aria-label="Group-select" id="realfileselect">
              <option value="0" selected>G</option>
              <option value="1">g1</option>
              <option value="2">g2</option>
              <option value="3">g3</option>
              <option value="4">g4</option>
              <option value="5">g5</option>
            </select>
            <div id="customfileSelect" class="dropdown">
              <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">group</button>
              <ul class="dropdown-menu" style="--bs-dropdown-min-width: 6rem;">
                <li><a class="dropdown-item group-1" href="#" data-value="1">⬤</a></li>
                <li><a class="dropdown-item group-2" href="#" data-value="2">⬤</a></li>
                <li><a class="dropdown-item group-3" href="#" data-value="3">⬤</a></li>
                <li><a class="dropdown-item group-4" href="#" data-value="4">⬤</a></li>
                <li><a class="dropdown-item group-5" href="#" data-value="5">⬤</a></li>
                <li><a class="dropdown-item group-0" href="#" data-value="0">group</a></li>
              </ul>
            </div>
          </div>
        </div>
      </form>
    
    <!--Pulsante indietro-->
    <button id="backfilebutton" class="btn btn-outline-secondary btn-sm rounded-circle position-absolute top-0 end-0 mt-4 me-4">🡨</button>
    
    <!--Pulsante per salvare Note-->
    <button id="savefilebtn" class="roundbtn">🡩</button>
    
    ` )
    bindFileEvents();
}

//funzioni per l'aggiunta di note
function bindFileEvents() {

    //seleziona il gruppo del file
    $("#customfileSelect .dropdown-item").on("click", function (e) {
      e.preventDefault();
      const value = $(this).data("value");
      const label = $(this).text();
      const groupClass = $(this).attr("class").match(/group-\d/);
      const $button = $("#customfileSelect button");

      $button.removeClass("group-1 group-2 group-3 group-4 group-5");
      
      if (groupClass) {
        $button.addClass(groupClass[0]);
      }

      $("#realfileselect").val(value);
      $("#customfileSelect button").text(label);
    });

    //tasto per andare indietro
    $("#backfilebutton").on("click", function() {
      $.ajax({
        url:"filemanager/card.html",
        method: "GET",
        success:function(res) {
          $("#filecont").html(res);
        }
      })
    })

    //tasto per salvare il file
    $("#savefilebtn").on("click", async function () {
      alertnum++
      const alertId = `alertfile-${alertnum}`;

      const file = $("#fileInput")[0].files[0];
      if (!file) {
        let text = `<b>Errore:</b> Devi inserire prima un file!`
        addAlert("danger", text, alertId);
        return
      };

      let fileName = file.name
      let fileSize = (file.size / (1024 * 1024)).toFixed(2)

      const iv = crypto.getRandomValues(new Uint8Array(12));

      const fileBuffer = await file.arrayBuffer();

      const encryptedContent = await crypto.subtle.encrypt(
          { name: "AES-GCM", iv: iv },
          key,
          fileBuffer
      );

      const base64IV = btoa(String.fromCharCode(...iv));
      
      // Use FormData to send the file and encrypted data
      const formData = new FormData();
      formData.append("filename", fileName);
      formData.append("filesize", fileSize);
      formData.append("iv", base64IV);
      formData.append("encryptedfile", new Blob([encryptedContent]), fileName);
      formData.append("group", $("#realfileselect").val());

      // Send the data using AJAX
  $.ajax({
    url: "filemanager/logic.php",
    method: "POST",
    data: formData,
    processData: false, // Don't process data as a query string
    contentType: false, // Don't set content-type header, let FormData handle it
    success: function(response) {
      console.log("File encrypted and uploaded successfully!");
      // Handle the success response if needed
    },
    error: function(xhr, status, error) {
      console.error("Upload failed:", error);
      let text = `<b>Errore:</b> C'è stato un errore durante il caricamento del file!`;
      addAlert("danger", text, alertId);
    }
  });


      //ritorno alla lista di file quando si finisce di caricare
      $.ajax({
        url:"filemanager/card.html",
        method: "GET",
        success:function(res) {
          $("#filecont").html(res);
        }
      })
    });
  }