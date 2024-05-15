<?php

include 'SHA3KECCAK.php';

$sha3 = new SHA3KECCAK();
$input = "ESDuQ4E8A3IUvZW49bQyYA==";
$mdlen = 256; // Can be 244, 256, 384, or 512
$rawOutput = false; // Set to true if you want raw output

$hash = $sha3::hash($input, $mdlen, $rawOutput);
echo "Hash: " . $hash;