<?php include"include/database.php";

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://efemobilemoney.com/go/run.php',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS =>'{"transactionReference":"MNFY|96|20210904181940|003624","paymentReference":"MNFY|96|20210904181940|003624","amountPaid":"30.00","totalPayable":"30.00","settlementAmount":"29.75","paidOn":"04\\/09\\/2021 06:19:40 PM","paymentStatus":"PAID","paymentDescription":"Efe","transactionHash":"f737d80bf58e481fb66664f2a4215a7c1ff747290157eed7e8b35228433607847ea5a2373b26faf8df28d84378b8e297df7419496b6dded26f259883c91c2281","currency":"NGN","paymentMethod":"ACCOUNT_TRANSFER","product":{"type":"RESERVED_ACCOUNT","reference":"emmext"},"cardDetails":null,"accountDetails":{"accountName":"Sunday Akinlabi","accountNumber":"***8645","bankCode":"000001","amountPaid":"30.00"},"accountPayments":[{"accountName":"Sunday Akinlabi","accountNumber":"***8645","bankCode":"000001","amountPaid":"30.00"}],"customer":{"email":"e.ozoma@5starcompany.com.ng","name":"Efe Mobile Money"},"metaData":[]}',
CURLOPT_HTTPHEADER => array(
'Content-Type: application/json'
),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
?>