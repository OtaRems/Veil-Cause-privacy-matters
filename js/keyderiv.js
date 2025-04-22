const keyManager = (() => {
    const storageKey = "aesKey";

    // Encode string to Uint8Array
    function encode(str) {
        return new TextEncoder().encode(str);
    }

    // Convert ArrayBuffer to Base64
    function arrayBufferToBase64(buffer) {
        const bytes = new Uint8Array(buffer);
        return btoa(String.fromCharCode(...bytes));
    }

    // Convert Base64 to ArrayBuffer
    function base64ToArrayBuffer(base64) {
        const binary = atob(base64);
        const bytes = new Uint8Array([...binary].map(c => c.charCodeAt(0)));
        return bytes.buffer;
    }

    return {
        // Derive a 256-bit AES-GCM key from password and salt
        async deriveKey(password, salt) {
            const keyMaterial = await crypto.subtle.importKey(
                "raw",
                encode(password),
                { name: "PBKDF2" },
                false,
                ["deriveKey"]
            );

            const key = await crypto.subtle.deriveKey(
                {
                    name: "PBKDF2",
                    salt: encode(salt),
                    iterations: 100000,
                    hash: "SHA-256"
                },
                keyMaterial,
                { name: "AES-GCM", length: 256 },
                true,
                ["encrypt", "decrypt"]
            );

            await this.storeKey(key);
            return key;
        },

        // Store key in sessionStorage as Base64
        async storeKey(key) {
            const raw = await crypto.subtle.exportKey("raw", key);
            const base64 = arrayBufferToBase64(raw);
            sessionStorage.setItem(storageKey, base64);
        },

        // Load key from sessionStorage (returns null if missing)
        async loadKey() {
            const base64 = sessionStorage.getItem(storageKey);
            if (!base64) return null;

            const raw = base64ToArrayBuffer(base64);
            return await crypto.subtle.importKey(
                "raw",
                raw,
                "AES-GCM",
                false,
                ["encrypt", "decrypt"]
            );
        },

        // Clear the key from sessionStorage
        clearKey() {
            sessionStorage.removeItem(storageKey);
        },

        // Check if key exists in sessionStorage
        hasKey() {
            return sessionStorage.getItem(storageKey) !== null;
        }
    };
})();
