<?php include("include/database.php");
// Check, if username session is NOT set then this page will jump to login page



if ($json = json_decode(file_get_contents("php://input"), true)) {
    print_r($json['transactionReference']);
    print_r($json['accountDetails']['accountName']);
    $data = $json;

}
$paid=$data["paymentStatus"];
$refid=$data["paymentReference"];
$acct= strtoupper($data["accountDetails"]["accountName"]);
$bank=$data["accountDetails"]["bankCode"];
$amount=$data["accountDetails"]["amountPaid"];
$no=substr( $data["accountDetails"]["accountNumber"],6);
//  echo $amount;
// echo $bank;
//echo $acct;

$query="SELECT * FROM banks WHERE account_no ='$no'";
$result = mysqli_query($con,$query);
while ($row = mysqli_fetch_array($result)) {
    $ubank="$row[bank_name]";
    $account="$row[account_no]";
    $username="$row[username]";
    $name=strtoupper($row["account_name"]);
}
echo $username;

//return $username;

if ($acct==$name && $ubank==$bank) {
    $query="SELECT * FROM deposit";
    $result = mysqli_query($con,$query);
    while ($row = mysqli_fetch_array($result)) {
        $d=$row["payment_ref"];

    }
    if($d==$refid){
        echo "payment refid the same";
    }else{
        $query="SELECT * FROM  wallet WHERE username='$username'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result))
        {
            $ubalance=$row["balance"];
        }
//        $vat=$amount*0.02;
        $pay=$amount-70;

        $fwallet=$ubalance+$amount;
        $query=mysqli_query($con,"insert into deposit (status, username, amount, payment_ref,  iwallet, fwallet, date) values (1,'$username', '$pay', '$refid', '$ubalance', '$fwallet', CURRENT_TIMESTAMP)");
        mysqli_query($con,"INSERT INTO `charge`( `username`, `payment_ref`, `amount`, `iwallet`, `fwallet`, `description`) VALUES ('$username', 'Charge_$refid', '70', '$ubalance', '$fwallet', 'Being Charge For Fund Transfer' )");
        echo $query;
        $result=mysqli_query($con,"update wallet set balance=balance+$pay WHERE username='$username'");
        $query="SELECT * FROM deposit where username ='$username'";
        $result = mysqli_query($con,$query);
        while ($row = mysqli_fetch_array($result)) {
            $depositor=$row["amount"];
            $iwallet=$row["iwallet"];

        }
        $query="SELECT * FROM users where username = '$username'";
        $result = mysqli_query($con,$query);
        while ($row = mysqli_fetch_array($result)) {
            $username = $row["username"];
            $name = $row["name"];
            $email = $row["email"];
        }
    }

}
$name=decryptdata($name);
$mail= "info@renomobilemoney.com";
$to = decryptdata($email);
$from = $mail;

$headers = "From: $from";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$subject = "$name|Account Funded | $refid";

$logo = '<img src="public/images/logo/logo.png" alt="logo">';
$link = '#';

$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
$body .= "<table style='width: 100%;'>";
$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
$body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
$body .="$acct $bank $amount $refid";
$body .= "<body style='width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'> 
  <div class='es-wrapper-color' style='background-color:#FAFAFA'> 
   <!--[if gte mso 9]>
			<v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
				<v:fill type='tile' color='#fafafa'></v:fill>
			</v:background>
		<![endif]--> 
   <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA'> 
     <tr> 
      <td valign='top' style='padding:0;Margin:0'> 
       <table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr> 
          <td class='es-info-area' align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' bgcolor='#FFFFFF'> 
             <tr> 
              <td align='left' style='padding:20px;Margin:0'> 
               <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> 
                   <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='center' class='es-infoblock' style='padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#CCCCCC;font-size:12px'><a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px'>View online version</a></p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table cellpadding='0' cellspacing='0' class='es-header' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'> 
         <tr> 
          <td align='center' style='padding:0;Margin:0'> 
           <table bgcolor='#ffffff' class='es-header-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px'> 
             <tr> 
              <td align='left' style='padding:20px;Margin:0'> 
               <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td class='es-m-p0r' valign='top' align='center' style='padding:0;Margin:0;width:560px'> 
                   <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:10px;font-size:10px'><img src='https://lgftzw.stripocdn.email/content/guids/CABINET_6236481c7d26a46b42fba226fc9e554f/images/lo.jpeg' alt='Logo' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;font-size:12px' width='200' title='Logo'></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> ";
$body .= " <table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr> 
          <td align='center' style='padding:0;Margin:0'> 
           <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> 
             <tr> 
              <td align='left' style='padding:0;Margin:0;padding-top:15px;padding-left:20px;padding-right:20px'> 
               <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> 
                   <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:10px'><img src='https://lgftzw.stripocdn.email/content/guids/CABINET_6236481c7d26a46b42fba226fc9e554f/images/lo.jpeg' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='100'></td> 
                     </tr> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:10px'><h1 style='Margin:0;line-height:46px;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;font-size:46px;font-style:normal;font-weight:bold;color:#333333'>Wallet Funded</h1></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr> 
          <td align='center' style='padding:0;Margin:0'> 
           <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> 
             <tr> 
              <td align='left' style='Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px'> 
               <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> 
                   <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='center' class='es-m-p0r es-m-p0l' style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Detail Of Total Amount Funded</p></td> 
                     </tr> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><span class='es-button-border' style='border-style:solid;border-color:#2CB543;background:#404040;border-width:0px;display:inline-block;border-radius:5px;width:auto'><a href='' class='es-button' target='_blank' style='mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;border-style:solid;border-color:#2ba316;border-width:10px 30px 10px 30px;display:inline-block;background:#5C68E2;border-radius:5px;font-family:arial, helvetica neue, helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center'>$name</a></span></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
             <tr> 
              <td align='left' style='padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px'> 
               <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td class='es-m-p0r' align='center' style='padding:0;Margin:0;width:560px'> 
                   <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-top:2px solid #efefef;border-bottom:2px solid #efefef' role='presentation'> 
                     <tr> 
                      <td align='right' class='es-m-txt-r' style='padding:0;Margin:0;padding-top:10px;padding-bottom:20px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Amount Fund:&nbsp;<strong>NGN$pay</strong><br>Early Amount:&nbsp;<strong>NGN$iwallet</strong><br>Present Balance:&nbsp;<strong>NGN$fwallet</strong></p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> ";
$body .= "<tr> 
              <td align='left' style='Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px'> 
               <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td align='left' style='padding:0;Margin:0;width:560px'> 
                   <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Got a question?&nbsp;Email us at info@renomobilemoney.com.ng&nbsp;or give us a call at <a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#313335;font-size:14px'>0816 693 9205</a>.</p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table cellpadding='0' cellspacing='0' class='es-footer' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'> 
         <tr> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-footer-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px'> 
             <tr> 
              <td align='left' style='Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px'> 
               <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td align='left' style='padding:0;Margin:0;width:560px'> 
                   <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-top:15px;padding-bottom:15px;font-size:0'> 
                       <table cellpadding='0' cellspacing='0' class='es-table-not-adapt es-social' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                         <tr> 
                          <td align='center' valign='top' style='padding:0;Margin:0;padding-right:40px'><img title='Facebook' src='https://lgftzw.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png' alt='Fb' width='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td> 
                          <td align='center' valign='top' style='padding:0;Margin:0;padding-right:40px'><img title='Twitter' src='https://lgftzw.stripocdn.email/content/assets/img/social-icons/logo-black/twitter-logo-black.png' alt='Tw' width='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td> 
                          <td align='center' valign='top' style='padding:0;Margin:0;padding-right:40px'><img title='Instagram' src='https://lgftzw.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png' alt='Inst' width='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td> 
                          <td align='center' valign='top' style='padding:0;Margin:0'><img title='Youtube' src='https://lgftzw.stripocdn.email/content/assets/img/social-icons/logo-black/youtube-logo-black.png' alt='Yt' width='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:35px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:18px;color:#333333;font-size:12px'>© 2021 Renomobilemoney, Inc. All Rights Reserved.</p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:18px;color:#333333;font-size:12px'><br></p></td> 
                     </tr> 
                     <tr> 
                      <td style='padding:0;Margin:0'> 
                       <table cellpadding='0' cellspacing='0' width='100%' class='es-menu' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                         <tr class='links'> 
                          <td align='center' valign='top' width='33.33%' style='Margin:0;padding-left:5px;padding-right:5px;padding-top:5px;padding-bottom:5px;border:0'><a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, helvetica neue, helvetica, sans-serif;color:#333333;font-size:12px'>Visit Us </a></td> 
                          <td align='center' valign='top' width='33.33%' style='Margin:0;padding-left:5px;padding-right:5px;padding-top:5px;padding-bottom:5px;border:0;border-left:1px solid #cccccc'><a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, helvetica neue, helvetica, sans-serif;color:#333333;font-size:12px'>Privacy Policy</a></td> 
                          <td align='center' valign='top' width='33.33%' style='Margin:0;padding-left:5px;padding-right:5px;padding-top:5px;padding-bottom:5px;border:0;border-left:1px solid #cccccc'><a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, helvetica neue, helvetica, sans-serif;color:#333333;font-size:12px'>Terms of Use</a></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table cellpadding='0' cellspacing='0' class='es-content' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr> 
          <td class='es-info-area' align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' align='center' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' bgcolor='#FFFFFF'> 
             <tr> 
              <td align='left' style='padding:20px;Margin:0'> 
               <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td align='center' valign='top' style='padding:0;Margin:0;width:560px'> 
                   <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='center' class='es-infoblock' style='padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:14px;color:#CCCCCC;font-size:12px'><a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px'></a>No longer want to receive these emails?&nbsp;<a href='' target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px'>Unsubscribe</a>.<a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px'></a></p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table></td> 
     </tr> 
   </table> 
  </div>  
 </body>";


$send = mail($to, $subject, $body, $headers);
$send = mail($from, $subject, $body, $headers);


$query="SELECT * FROM users where username = '$username'";
$result = mysqli_query($con,$query);
while ($row = mysqli_fetch_array($result)) {
    $username = $row["username"];
    $name3 = $row["name"];
    $email = $row["email"];
}
$name1=decryptdata($name3);
$receiver=decryptdata($username);
$mail= "info@renomobilemoney.com";
$to = decryptdata($email);
$from = $mail;

$headers = "From: $from";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$subject = "$receiver|Account Being Charge | Reno-$refid";
$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
$body .= "<table style='width: 100%;'>";
$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
$body .= " <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA'> 
     <tr> 
      <td valign='top' style='padding:0;Margin:0'> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr> 
          <td class='es-info-area' align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' bgcolor='#FFFFFF' align='center'> 
             <tr> 
              <td align='left' style='padding:20px;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:560px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td class='es-infoblock' align='center' style='padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC'><br></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> 
             <tr> 
              <td align='left' style='padding:0;Margin:0;padding-top:15px;padding-left:20px;padding-right:20px'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:560px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:0px' align='center'><img src='https://lgftzw.stripocdn.email/content/guids/CABINET_6236481c7d26a46b42fba226fc9e554f/images/lo.jpeg' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='150' height='150'></td> 
                     </tr> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:10px'>Account Being Charge By Admin<br></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> ";
$body .= " <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr> 
          <td style='padding:0;Margin:0;background-image:url(https://rszomp.stripocdn.email/content/guids/CABINET_c2a5428bd0934f3fbd34e54cb3601b70/images/32801632220122584.jpg);background-repeat:no-repeat;background-position:left top' background='https://lgftzw.stripocdn.email/content/guids/CABINET_6236481c7d26a46b42fba226fc9e554f/images/lo.jpeg' align='center'> 
           <table class='es-content-body' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> 
             <tr> 
              <td align='left' style='Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:560px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td class='es-m-p0r es-m-p0l' align='center' style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Dear $receiver,<br></p></td> 
                     </tr> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><span class='es-button-border' style='border-style:solid;border-color:#2CB543;background:#187b07;border-width:0px;display:inline-block;border-radius:5px;width:auto'><a href='' class='es-button' target='_blank' style='mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;border-style:solid;border-color:#187b07;border-width:10px 30px 10px 30px;display:inline-block;background:#187b07;border-radius:5px;font-family:arial, helvetica neue, helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center'>$name1</a></span></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> ";
$body .= "  <tr> 
              <td style='Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px;background-image:url(https://rszomp.stripocdn.email/content/guids/CABINET_c2a5428bd0934f3fbd34e54cb3601b70/images/32801632220122584.jpg);background-repeat:no-repeat;background-position:left top' background='https://rszomp.stripocdn.email/content/guids/CABINET_c2a5428bd0934f3fbd34e54cb3601b70/images/32801632220122584.jpg' align='left'> 
               <!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:280px' valign='top'><![endif]--> 
               <table class='es-left' cellspacing='0' cellpadding='0' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'> 
                 <tr> 
                  <td class='es-m-p0r es-m-p20b' align='center' style='padding:0;Margin:0;width:280px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='left' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Customer: <strong>$name1</strong></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Reference Number:&nbsp;<strong>Reno-$refid</strong><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Invoice date:&nbsp;<strong>$date</strong><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Payment method: <strong>Admin_Charges</strong><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Currency: <strong>NGN</strong><br></p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table> 
               <!--[if mso]></td><td style='width:0px'></td><td style='width:280px' valign='top'><![endif]--> 
               <table class='es-right' cellspacing='0' cellpadding='0' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right'> 
                 <tr> 
                  <td class='es-m-p0r' align='center' style='padding:0;Margin:0;width:280px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td class='es-m-txt-l' align='left' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Amount Fund: <strong>NGN70.00</strong></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Email address: $to</p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'><strong>Account Being Charge BY <br>Admin <br></strong></p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> ";
$body .= "  <tr> 
              <td align='left' style='Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td align='left' style='padding:0;Margin:0;width:560px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Got a question?&nbsp;Email us at info@efemobilemoney.com or give us a call at 0816 693 9205</p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-footer' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top'> 
         <tr> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-footer-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr> 
              <td align='left' style='Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td align='left' style='padding:0;Margin:0;width:560px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td style='padding:0;Margin:0;padding-top:15px;padding-bottom:15px;font-size:0' align='center'> 
                       <table class='es-table-not-adapt es-social' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                         <tr> 
                          <td valign='top' align='center' style='padding:0;Margin:0;padding-right:40px'><img title='Facebook' src='https://rszomp.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png' alt='Fb' width='32' height='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td> 
                          <td valign='top' align='center' style='padding:0;Margin:0;padding-right:40px'><img title='Twitter' src='https://rszomp.stripocdn.email/content/assets/img/social-icons/logo-black/twitter-logo-black.png' alt='Tw' width='32' height='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td> 
                          <td valign='top' align='center' style='padding:0;Margin:0;padding-right:40px'><img title='Instagram' src='https://rszomp.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png' alt='Inst' width='32' height='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td> 
                          <td valign='top' align='center' style='padding:0;Margin:0'><img title='Youtube' src='https://rszomp.stripocdn.email/content/assets/img/social-icons/logo-black/youtube-logo-black.png' alt='Yt' width='32' height='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td> 
                         </tr> 
                       </table></td> 
                     </tr> ";
$body .= " <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:35px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:18px;color:#333333;font-size:12px'>4562 Hazy Panda Limits, Chair Crossing, If you have any questions/issues, please contact us at&nbsp;<a href='mailto:info@5starcompany.com.ng' target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#333333;font-size:12px'>info@</a>renomobilemoney.com<br>Thanks for choosing us</p></td> 
                     </tr> 
                     <tr> 
                      <td style='padding:0;Margin:0'> 
                       <table class='es-menu' width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                         <tr class='links'> 
                          <td style='Margin:0;padding-left:5px;padding-right:5px;padding-top:5px;padding-bottom:5px;border:0' width='33.33%' valign='top' align='center'><a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#333333;font-size:12px'>Visit Us </a></td> 
                          <td style='Margin:0;padding-left:5px;padding-right:5px;padding-top:5px;padding-bottom:5px;border:0;border-left:1px solid #cccccc' width='33.33%' valign='top' align='center'><a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#333333;font-size:12px'>Privacy Policy</a></td> 
                          <td style='Margin:0;padding-left:5px;padding-right:5px;padding-top:5px;padding-bottom:5px;border:0;border-left:1px solid #cccccc' width='33.33%' valign='top' align='center'><a target='_blank' href='' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, 'helvetica neue', helvetica, sans-serif;color:#333333;font-size:12px'>Terms of Use</a></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table></td> 
     </tr> 
   </table> ";
$send = mail($to, $subject, $body, $headers);
$send = mail($from, $subject, $body, $headers);

?>