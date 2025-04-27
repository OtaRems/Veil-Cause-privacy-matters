function addFileState() {
    $("#filecont").html(` 
      <form class="px-3">
        <div class="btn-toolbar position-absolute bottom-0 p-4 mt-3">
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

        <input type="file" id="fileInput" class="form-control"></input>
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