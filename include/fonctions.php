<?php
function secureData($data, $action = 'encrypt') {
    // Lire la clé de chiffrement depuis le fichier
    $encryption_key = file_get_contents('/etc/secure_keys/secure_key.txt');
    
    // Vérifier si la clé a bien été lue
    if ($encryption_key === false) {
        die("Impossible de lire la clé de chiffrement.");
    }

    $method = 'AES-256-CBC'; // Algorithme de chiffrement

    if ($action == 'encrypt') {
        // Chiffrement avec la clé lue du fichier
        $encryptedData = openssl_encrypt($data, $method, $encryption_key, 0, str_repeat("\0", 16)); // Utilisation d'un IV de zéros
        return base64_encode($encryptedData);
    }

    if ($action == 'decrypt') {
        // Décryptage avec la clé lue du fichier et l'IV de zéros
        $encryptedData = base64_decode($data);
        return openssl_decrypt($encryptedData, $method, $encryption_key, 0, str_repeat("\0", 16));
    }
}
?>