async function encryptNote(titoloPlain, testoPlain, pubkey) {

    const encoder = new TextEncoder();
    const titoloData = encoder.encode(titoloPlain);
    const testoData = encoder.encode(testoPlain);

    const iv = crypto.getRandomValues(new Uint8Array(12)); // IV per AES-GCM

    if (!(pubkey instanceof CryptoKey)) {
        console.error("pubkey non è una CryptoKey valida:", pubkey);
        throw new Error("Chiave pubblica non valida.");
    }

    try {
        // 1. Genera una chiave AES randomica
        const aesKey = await crypto.subtle.generateKey(
            { name: "AES-GCM", length: 256 },
            true,
            ["encrypt", "decrypt"]
        );

        // 2. Cifra titolo e testo con AES
        const cryptTitle = await crypto.subtle.encrypt(
            { name: "AES-GCM", iv },
            aesKey,
            titoloData
        );

        const cryptText = await crypto.subtle.encrypt(
            { name: "AES-GCM", iv },
            aesKey,
            testoData
        );

        // 3. Esporta la chiave AES in formato raw
        const rawAesKey = await crypto.subtle.exportKey("raw", aesKey);

        // 4. Cifra la chiave AES con la chiave pubblica RSA dell'utente
        const encryptedAesKey = await crypto.subtle.encrypt(
            { name: "RSA-OAEP" },
            pubkey,
            rawAesKey
        );

        // 5. Converti tutto in Base64
        const base64Title = btoa(String.fromCharCode(...new Uint8Array(cryptTitle)));
        const base64Text = btoa(String.fromCharCode(...new Uint8Array(cryptText)));
        const base64IV = btoa(String.fromCharCode(...iv));
        const base64EncryptedKey = btoa(String.fromCharCode(...new Uint8Array(encryptedAesKey)));

        return {
            base64Title,
            base64Text,
            base64IV,
            base64EncryptedKey
        };
    } catch (error) {
        console.error("Errore durante la cifratura ibrida:", error);
        throw error;
    }
}
