function addAlert(type, text, alertId,) {

    const alertHtml = `
      <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${text}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `
    $("#toastdiv").append(alertHtml)
    setTimeout(() => {
      $(`#${alertId}`).alert("close");
    }, 2000);
    return
}