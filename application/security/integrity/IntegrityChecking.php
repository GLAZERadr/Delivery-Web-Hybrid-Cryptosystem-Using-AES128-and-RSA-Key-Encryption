<?php

class IntegrityChecking {

    private $sha3;

    public function __construct() {
        $this->sha3 = new SHA3KECCAK();
    }

    public function hashChecking($cipherText, $hashValue) {
        $cipherTextHash = $this->sha3::hash($cipherText, 256, false);

        if($cipherTextHash == $hashValue) {
            return true;
        } else {
            return false;
        }
    }
}