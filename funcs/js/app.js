if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
      navigator.serviceWorker.register('/service-worker.js')
          .then(registration => {
            return
          })
          .catch(error => {
              console.error('Errore nella registrazione del Service Worker:', error);
          });
  });
}
