<?php

require_once 'application/security/encryption/AES128Encryption.php';
require_once 'application/security/encryption/RSAEncryption.php';

class HybridCryptosystem
{
    private $rsa;
    
    public function __construct($publicKey, $privateKey) {
        $publicKey = file_get_contents($publicKey);
        $privateKey = file_get_contents($privateKey);

        $this->rsa = new RSAEncryption($publicKey, $privateKey);
    }

    public function encryptData($data) {
        $key = "AdrianBadjideh11";

        $aes = new AES128Encryption($key);

        $encryptedData = $aes->encrypt($data);

        $encryptedPrivateKey = $this->rsa->encodePrivateKey($key);
        $encryptedPublicKey = $this->rsa->encodePublicKey($key);

        // echo 'encrypted key = '. $encryptedPrivateKey;

        return base64_encode(json_encode([
            'encryptedData' => $encryptedData,
            'encryptedKey' => $encryptedPrivateKey // gimana caranya buat ini kesimpen
        ]));
    }

    public function decryptData($cipher) {
        $decodedCipher = json_decode(base64_decode($cipher), true);

        // echo 'decoded cipher = '.$decodedCipher['encryptedKey'];

        $secretKey = $this->rsa->decodePrivateKey($decodedCipher['encryptedKey']);

        // echo 'secret key = '. $secretKey;

        $aes = new AES128Encryption($secretKey);
        $plainText = $aes->decrypt($decodedCipher['encryptedData']);

        return $plainText;
    }
}

$publicKeyPath = 'application/security/encryption/public_key.pem';
$privateKeyPath = 'application/security/encryption/private_key.pem';

$hybrid = new HybridCryptosystem($publicKeyPath, $privateKeyPath);

// $data = " eyJlbmNyeXB0ZWREYXRhIjoiU0VtU2VxaVFzbGU0VUdWRjlSYndzUT09IiwiZW5jcnlwdGVkS2V5IjoiWVRveE9udHBPakE3Y3pveU5UWTZJb3pxaEpWWHVNSHpFMmQwS0pGMWJweEl6T1F6OWZmS00yZnNodVwvVDk2c3pyVFlISkNITVp0b1NWMTlOV1BcL3FIRDhRZkhHZ3JrMjBnaUNHUXpmSmZnQ0JMbzJmRTFqU0pNWVVhOU50RlMzZk42TytLT09ET1FsZXpYaE5tVEJCWkxFaVwvYzNLS2FUU0FCdFliUk5ibFJORUI5WjhaczZWdnhyRWJvOURtd2M5WDMya1BaUThFK3dUeU5kMDUrM1wvXC9MNE1wa1VVaUVKMFAxK1lFYU1FUVBRbXpRTWlXdkl2WDE0WkZDb09oQzRjc2JpU1c5aGlaOXdzMk9ZalFhRzBEZHl2ak1RMWRub0V5QzJSUXJWSzFHa1g1UFpCNGVqS1g4M3pNd3NlZ29QMDNjMm9MUlZwbGU2bG5iZit6aTk0ZmZnREIzNjZuWTlTSWhCc1dkcFB1RXNpTzMwPSJ9";
// $encryptedData = $hybrid->encryptData($data);
// echo "Data terenkripsi: " . $encryptedData . "\n";

// $decryptedData = $hybrid->decryptData('eyJlbmNyeXB0ZWREYXRhIjoiYW5FTjJcL24xVmtEYys2ZDRkVWViYUE9PSIsImVuY3J5cHRlZEtleSI6IllUb3hPbnRwT2pBN2N6b3lOVFk2SW96cWhKVlh1TUh6RTJkMEtKRjFicHhJek9RejlmZktNMmZzaHVcL1Q5NnN6clRZSEpDSE1adG9TVjE5TldQXC9xSEQ4UWZIR2dyazIwZ2lDR1F6ZkpmZ0NCTG8yZkUxalNKTVlVYTlOdEZTM2ZONk8rS09PRE9RbGV6WGhObVRCQlpMRWlcL2MzS0thVFNBQnRZYlJOYmxSTkVCOVo4WnM2VnZ4ckVibzlEbXdjOVgzMmtQWlE4RSt3VHlOZDA1KzNcL1wvTDRNcGtVVWlFSjBQMStZRWFNRVFQUW16UU1pV3ZJdlgxNFpGQ29PaEM0Y3NiaVNXOWhpWjl3czJPWWpRYUcwRGR5dmpNUTFkbm9FeUMyUlFyVksxR2tYNVBaQjRlaktYODN6TXdzZWdvUDAzYzJvTFJWcGxlNmxuYmYremk5NGZmZ0RCMzY2blk5U0loQnNXZHBQdUVzaU8zMD0ifQ==');
// echo "Data didekripsi: " . $decryptedData . "\n";