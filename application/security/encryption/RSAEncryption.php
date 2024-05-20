<?php

class RSAEncryption 
{
    private $publicKey = null;
    private $privateKey = null;

    private static $blockSize = 86;

    public function __construct($publicKey, $privateKey) {
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
    }

    //helpers
    public function splitEncode($data) {
        $data = base64_encode($data);

        $length = strlen($data);

        $value = [];

        if ($length % self::$blockSize) {
            $blockTotal = $length / self::$blockSize;
        } else {
            $blockTotal = $length / self::$blockSize - 1;
        }

        for ($i = 0; $i < $blockTotal; $i++) {
            $value[] = substr($data, $i * self::$blockSize, self::$blockSize);
        }

        return $value;
    }

    public function encodePrivateKey($data) {
        $encryptedData = '';
    
        if (empty($this->privateKey)) {
            throw new Exception('Private Key is Empty');
        }

        $privatekey = openssl_pkey_get_private($this->privateKey);

        $encryptionResults = [];

        $dataArray = $this->splitEncode($data);

        foreach ($dataArray as $valueArray) {
            openssl_private_encrypt($valueArray, $encryptedData, $privatekey);
            $encryptionResults[] = $encryptedData;
        }

        return base64_encode(serialize($encryptionResults));
    }

    public function encodePublicKey($data) {
        $encryptedData = '';

        if (empty($this->publicKey)) {
            throw new Exception('Public Key is Empty');
        }

        $publicKey = openssl_pkey_get_public($this->publicKey);

        $encryptionResults = [];

        $dataArray = $this->splitEncode($data);

        foreach ($dataArray as $valueArray) {
            openssl_public_encrypt($valueArray, $encryptedData, $publicKey);
            $encryptionResults[] = $encryptedData;
        }

        return base64_encode(serialize($encryptionResults));
    }

    public function decodePrivateKey($data) {
        $decryptedData = '';

        if (empty($this->publicKey)) {
            throw new Exception('Public Key is Empty');
        }

        $publicKey = openssl_pkey_get_public($this->publicKey);

        $data = base64_decode($data);

        $dataArray = unserialize($data);

        if (!is_array($dataArray)) {
            throw new Exception('Data is not an array');
        }

        $decryptionResults = '';

        foreach ($dataArray as $valueArray) {
            openssl_public_decrypt($valueArray, $decryptedData, $publicKey);
            $decryptionResults .= $decryptedData;
        }

        return base64_decode($decryptionResults);
    }

    public function decodePublicKey($data) {
        $decryptedData = '';

        if (empty($this->privateKey)) {
            throw new Exception('Private Key is Empty');
        }

        $privateKey = openssl_pkey_get_private($this->privateKey);

        $data = base64_decode($data);

        $dataArray = unserialize($data);

        if(!is_array($dataArray)) {
            throw new Exception('Data is not an array');
        }

        $decryptionResults = '';

        foreach ($dataArray as $valueArray) {
            openssl_private_decrypt($valueArray, $decryptedData, $privateKey);
            $decryptionResults .= $decryptedData; 
        }

        return base64_decode($decryptionResults);
    }
}