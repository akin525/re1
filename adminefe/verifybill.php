{"success":1,"message":"Withdrawal logged successfully","ref":"RW1637057326715173687"}


<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    // redirect them to your desired location
    header('location:404.php');
    exit;
}

include_once("include/database.php");

// Inialize session
//session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
    print "<script language='javascript'>	window.location = '../index.php';</script>";
}
//$productid=mysqli_real_escape_string($connection,$_GET['productid']);
$number = mysqli_real_escape_string($con, $_GET["number"]*1);
$networkcode = mysqli_real_escape_string($con, $_GET["networkcode"]);
//$provider = substr(mysqli_real_escape_string($connection, $_GET["provider"]), 0, 1);
//echo $networkcode . " ". $number;
//  $p=$number*1;
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=$number&bank_code=$networkcode",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_live_15001f29b396a714841ab44f5547801beb3855c2",
        "Cache-Control: no-cache",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
//    echo $response;
}

$data = json_decode($response, true);
$success = $data["status"];
$tran = $data["data"]["account_name"];

// Perform transaction/initialize on our server to buy
if ($tran == null) {
    echo "Verify Successful, Unable to identify account name";
} else {
    echo $tran;
}
return;

