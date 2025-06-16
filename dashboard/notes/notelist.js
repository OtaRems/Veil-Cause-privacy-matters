async function addNoteList(notes) {
    //svuotiamo le note
    $("#notelist").html("")

    if (!Array.isArray(notes) || notes.length === 0) {
        $("#notelist").html(`<div class='no-notes-msg position-absolute top-50 start-50 translate-middle text-center text-secondary'>Ops, non hai ancora inserito nessuna nota!</div>`)
        return;
      }
    
      for (const note of notes) {
        const iv = Uint8Array.from(atob(note.iv), c => c.charCodeAt(0));
        const titoloBuffer = Uint8Array.from(atob(note.titolo), c => c.charCodeAt(0));
        const testoBuffer = Uint8Array.from(atob(note.testo), c => c.charCodeAt(0));
        const encAesKey = Uint8Array.from(atob(note.notekey), c => c.charCodeAt(0));
        const key = await keyManager.decryptAesKey(encAesKey);
    
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
        testotagliato = testotagliato.replace(/<br\s*\/?>|<\/?(b|i|u)>/gi, "");
        var time = note.lastEdited.replace(/-/g, "/").substring(0,10)
    
        notelist = `<li id="note${note.IDNota}" data-group="${note.gruppo}" data-idnota="${note.IDNota}" class="list-group-item d-flex justify-content-between align-items-start border border-0">
          <div class="ps-2 me-auto">
              <div class="fw-bold">${titolo}</div>
              <span class="text-secondary">${testotagliato}</span>
                  <small class="position-absolute top-50 end-0 translate-middle-y text-secondary pe-4">${time}</small>
            </div>
          </li>`
          $("#notelist").append(notelist);
      }
}