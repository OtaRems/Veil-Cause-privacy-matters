<h4 class='ps-4 pt-4 evidtext'><b>Note</b></h4>
<div class='overflow-scroll' style='height:80%'>
  <ul id='notelist' class='list-group list-group-flush'>
  </ul>
<div class='mt-5 p-5 text-center text-secondary'>Ops, non hai ancora inserito nessuna nota!</div>
</div>

<!--Pulsante per aggiungere Note-->
<button id="addnotebtn" class="roundbtn">+</button>

<script>
    //spawniamo il popup quando vogliamo aggiungere una nota
    $("#addnotebtn").on("click", function() {
      $("#mainstuffcont").html("")
      $("#fullblur").removeClass("d-none");
  })
    </script>