<?php
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
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
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
