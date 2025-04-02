// Nome della cache
const CACHE_NAME = 'cache-v1';

// File da memorizzare nella cache
const FILES_TO_CACHE = [
    '/appEsame/',
    '/index.php',
    '/manifest.json',
    '/js/app.js'
];

// Installazione del Service Worker
self.addEventListener('install', event => {
    console.log('[Service Worker] Installazione...');
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            console.log('[Service Worker] Caching delle risorse...');
            return cache.addAll(FILES_TO_CACHE);
        })
    );
});

// Attivazione del Service Worker e pulizia delle vecchie cache
self.addEventListener('activate', event => {
    console.log('[Service Worker] Attivato');
    event.waitUntil(
        caches.keys().then(keyList => {
            return Promise.all(
                keyList.map(key => {
                    if (key !== CACHE_NAME) {
                        console.log('[Service Worker] Rimuovo vecchia cache:', key);
                        return caches.delete(key);
                    }
                })
            );
        })
    );
});

// Intercettare richieste di rete
self.addEventListener('fetch', event => {
  console.log('[Service Worker] Fetching:', event.request.url);
  
  event.respondWith(
      caches.match(event.request).then(response => {
          if (response) {
              console.log('[Service Worker] Restituisco dalla cache:', event.request.url);
              return response; // Se il file è nella cache, usalo
          }

          console.log('[Service Worker] Provo a scaricare:', event.request.url);
          return fetch(event.request).catch(() => {
              console.log('[Service Worker] Offline: impossibile recuperare', event.request.url);
              
              // Se è una richiesta di pagina, restituisci index.html (fallback)
              if (event.request.mode === 'navigate') {
                  return caches.match('/index.html');
              }
          });
      })
  );
});
