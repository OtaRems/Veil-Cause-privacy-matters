const encoder = new TextEncoder();
const data = encoder.encode("my secret note");

const password = "AntonioSuperPassword!";
const salt = crypto.getRandomValues(new Uint8Array(16));
const key = await deriveAESKey(password, salt); // PBKDF2

const iv = crypto.getRandomValues(new Uint8Array(12)); // AES-GCM needs IV
const ciphertext = await crypto.subtle.encrypt(
  { name: "AES-GCM", iv },
  key,
  data
);

// Result is ArrayBuffer → you might want to Base64 it for storage
