const keyManager = (() => {
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
        async deriveAesKey(password, salt) {
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
            return key;
        },

        // Decrypt the private key and save both keys in sessionStorage
        async StoreKeys(pubkeyBase64, privkeyEncBase64, ivBase64, aesKey) {

            if (!pubkeyBase64 || !privkeyEncBase64 || !ivBase64 || !aesKey) {
                throw new Error("Chiavi mancanti o AESKey non inizializzata");
            }

            // Convert Base64 inputs to ArrayBuffers
            const privkeyEncBuffer = base64ToArrayBuffer(privkeyEncBase64);
            const iv = base64ToArrayBuffer(ivBase64);
            
            // Decrypt private key with AES-GCM
            let decryptedPrivKeyBuffer;
            try {
                decryptedPrivKeyBuffer = await crypto.subtle.decrypt(
                    {
                        name: "AES-GCM",
                        iv: iv
                    },
                    aesKey,
                    privkeyEncBuffer
                );
            } catch (e) {
                console.error("Decryption of private key failed:", e);
                throw new Error("Invalid AES key or corrupted encrypted private key.");
            }

            // Optionally serialize and save Base64 versions for reload
            sessionStorage.setItem("publicKey", pubkeyBase64);
            sessionStorage.setItem("privateKey", arrayBufferToBase64(decryptedPrivKeyBuffer));


            console.log("Chiavi importate e salvate correttamente in sessionStorage.");
        },

        async loadAndImportKeys() {
            const pubkeyBase64 = sessionStorage.getItem("publicKey");
            const privkeyBase64 = sessionStorage.getItem("privateKey");
        
            if (!pubkeyBase64 || !privkeyBase64) {
                throw new Error("Dati delle chiavi mancanti o corrotti");
            }
        
            const pubkeyBuffer = base64ToArrayBuffer(pubkeyBase64);
            const privkeyBuffer = base64ToArrayBuffer(privkeyBase64);
        
        
            const publicKey = await crypto.subtle.importKey(
                "spki",
                pubkeyBuffer,
                { name: "RSA-OAEP", hash: "SHA-256" },
                true,
                ["encrypt"]
            );
        
            const privateKey = await crypto.subtle.importKey(
                "pkcs8",
                privkeyBuffer,
                { name: "RSA-OAEP", hash: "SHA-256" },
                true,
                ["decrypt"]
            );        
            return { publicKey, privateKey };
        },
        
        hasKey() {
            return sessionStorage.getItem("privateKey") !== null && sessionStorage.getItem("publicKey") !== null;
        },

        async decryptAesKey(encryptedAesKey) {
            const decryptedAesKeyBuffer = await crypto.subtle.decrypt(
            { name: "RSA-OAEP" },
            privateKey,  // private RSA key
            encryptedAesKey
        );

        // Re-import the AES key (AES-GCM)
        const key = await crypto.subtle.importKey(
            "raw",
            decryptedAesKeyBuffer,
            { name: "AES-GCM" },
            true,  // The key is extractable
            ["encrypt", "decrypt"]  // Usable for encryption and decryption
        );
        
        return key;
        }
    };

})();