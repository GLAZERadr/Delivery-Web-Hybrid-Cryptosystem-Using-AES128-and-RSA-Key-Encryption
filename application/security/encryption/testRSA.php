<?php

// Sertakan kelas RSAEncryption
require_once 'RSAEncryption.php';

// Membaca kunci dari file
$publicKey = file_get_contents('application/security/encryption/public_key.pem');
$privateKey = file_get_contents('application/security/encryption/private_key.pem');

// Buat instance dari kelas RSAEncryption
$rsa = new RSAEncryption($publicKey, $privateKey);

// Data yang akan dienkripsi
$data = openssl_random_pseudo_bytes(16);

// Mengenkripsi dengan kunci private
echo "Data asli: " . $data . "\n";

$encryptedWithPrivateKey = $rsa->encodePrivateKey($data);
echo "Data terenkripsi dengan kunci privat: " . $encryptedWithPrivateKey . "\n";

// Mendekripsi dengan kunci publik
$decryptedWithPublicKey = $rsa->decodePrivateKey($encryptedWithPrivateKey);
echo "Data terdekripsi dengan kunci publik: " . $decryptedWithPublicKey . "\n";

// Mengenkripsi dengan kunci publik
$encryptedWithPublicKey = $rsa->encodePublicKey($data);
echo "Data terenkripsi dengan kunci publik: " . $encryptedWithPublicKey . "\n";

// // Mendekripsi dengan kunci privat
// $decryptedWithPrivateKey = $rsa->decodePublicKey($encryptedWithPublicKey);
// echo "Data terdekripsi dengan kunci privat: " . $decryptedWithPrivateKey . "\n";