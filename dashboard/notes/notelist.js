async function addNoteList(notes) {
    //svuotiamo le note
    $("#notelist").html("")

    if (!Array.isArray(notes) || notes.length === 0) {
        $("#notelist").html(`<div class='mt-5 p-5 text-center text-secondary'>Ops, non hai ancora inserito nessuna nota!</div>`)
        return;
      }
    
      for (const note of notes) {
        const iv = Uint8Array.from(atob(note.iv), c => c.charCodeAt(0));
        const titoloBuffer = Uint8Array.from(atob(note.titolo), c => c.charCodeAt(0));
        const testoBuffer = Uint8Array.from(atob(note.testo), c => c.charCodeAt(0));
    
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
        var testotagliato = testo.length > 30 ? testo.substring(0, 30) + "..." : testo;
    
        // 👇 Ora puoi aggiungerli al DOM come vuoi
        notelist = `<li id="note${note.IDNota}" data-group="${note.gruppo}" data-idnota="${note.IDNota}" class="list-group-item d-flex justify-content-between align-items-start border border-0">
          <div class="ps-2 me-auto">
              <div class="fw-bold">${titolo}</div>
              <span class="text-secondary">${testotagliato}</span>
            </div>
          </li>`
          $("#notelist").append(notelist);
      }

      $("#notelist .list-group-item").on("click", function(nota) {
        console.log($(this).data("idnota"))
      })
}