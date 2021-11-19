<?php
// Enable us to use Headers
ob_start();

// Set sessions
if(!isset($_SESSION)) {
    session_start();
}

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "efe";

$con = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");
function encryptdata($plain)
{
    $aeskey="A3BB18B5E19B1ACBE661AFFC228A01B4";
    $ivkey="3AF472DB3BF7DCCB";
    return bin2hex(openssl_encrypt($plain, "aes-128-cbc", $aeskey, OPENSSL_RAW_DATA,$ivkey));
}

function decryptdata($encriptedData)
{
    $aeskey="A3BB18B5E19B1ACBE661AFFC228A01B4";
    $ivkey="3AF472DB3BF7DCCB";
    $ciphertext = hex2bin($encriptedData);
    return openssl_decrypt($ciphertext, "aes-128-cbc",$aeskey, OPENSSL_RAW_DATA, $ivkey);
}
?>
