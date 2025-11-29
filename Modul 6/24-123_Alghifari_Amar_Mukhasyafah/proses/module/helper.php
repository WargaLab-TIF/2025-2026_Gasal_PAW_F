<?php

function generateRandomString($length = 20) {
    // Generate cryptographically secure random bytes
    $bytes = random_bytes(ceil($length / 2)); 
    
    // Convert the random bytes to a hexadecimal string
    $hexString = bin2hex($bytes);
    
    // Return the desired length of the string
    return substr($hexString, 0, $length);
}