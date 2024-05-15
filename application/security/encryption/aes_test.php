<?php
// Include the AES128 class
include 'AES128Encryption.php';

// Instantiate the AES128 class with a key
$aes = new AES128Encryption("AdrianBadjideh11");

// Data to encrypt
$data = "-2.965504";

// Encrypt the data
$encrypted_data = "UO3DuI55IRLVv4BbWrjSPg==";

echo "Encrypted data: " . $encrypted_data . "\n";

// // Decrypt the data
$decrypted_data = $aes->decrypt($encrypted_data);

echo "Decrypted data: " . $decrypted_data . "\n";
?>
