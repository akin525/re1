<?php include "sidebar.php"; ?>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row page-breadcrumbs">
                    <div class="col-md-12 align-self-center">
                        <h4 class="theme-cl">Refund Wallet</h4>
                    </div>
                </div>
                <!-- Title & Breadcrumbs-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="row">
                                <!-- col-md-6 -->
                                <div class="col-md-12 col-12">

                                    <div class="form-group">
                                        <div class="contact-thumb">
                                            <h1><i class="fa i-cl-4 fa-money"></i></h1>
                                        </div>
                                    </div>




                                    <div class="col-md-12">
                                        <?php
                                        $receiver=$amount=$cpass="";

                                        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']) && isset($_POST['receiver']))
                                        {


// Collect the data from post method of form submission //
                                            $cpass=mysqli_real_escape_string($con,$_POST['cpass']);
//                                                    $cpass = md5($cpass);
                                            $ccpass=mysqli_real_escape_string($con,$_POST['ccpass']);

                                            $amount=mysqli_real_escape_string($con,$_POST['amount']);
                                            $receiver= encryptdata(mysqli_real_escape_string($con,$_POST['receiver']));
                                            $description=mysqli_real_escape_string($con,$_POST['description']);
//collection ends


                                            $status = "OK";
                                            $msg="";

                                            if($receiver!=""){

                                                $result = mysqli_query($con,"SELECT * FROM  users where username = '$receiver'");
                                                $row = mysqli_fetch_row($result);
                                                $numrows = $row[0];
                                                if ($numrows==0)
                                                {
                                                    $receiver=decryptdata($receiver);
                                                    $msg=$msg."$receiver Not Found On Our System.<BR>";
                                                    $status= "NOTOK";
                                                }

                                                if ( $ccpass!==$cpass ){
                                                    $msg=$msg."Current Password Is Wrong.<BR>";
                                                    $status= "NOTOK";
                                                }
                                                $queri="SELECT * FROM  wallet WHERE username='".$receiver."'";
                                                $resultb = mysqli_query($con,$queri);
                                                while($row = mysqli_fetch_array($resultb))
                                                {
                                                    $ubalance=$row["balance"];
                                                    echo "$ubalance";
                                                }
                                                $queri="SELECT * FROM  users WHERE username='".$receiver."'";
                                                $resultb = mysqli_query($con,$queri);
                                                while($row = mysqli_fetch_array($resultb))
                                                {
                                                    $email=$row["email"];
//                                    echo "$ubalance";
                                                }

//$bal=($camount-$amount);
//validation starts
// if userid is less than 6 char then status is not ok



                                                if ($status=="OK")
                                                {
                                                    $amount = mysqli_real_escape_string($con, $_POST['amount']);
                                                    $refid=rand(1111111111,9999999999);
                                                    $fwallet=$ubalance+$amount;
//echo "INSERT INTO `deposit`( `status`, `username`, `payment_ref`, `amount`, `iwallet`, `fwallet`) VALUES (1,'$receiver', '$refid', '$amount', '$ubalance', '$fwallet' )";

//                                                    mysqli_query($con,"INSERT INTO `deposit`( `status`, `username`, `payment_ref`, `amount`, `iwallet`, `fwallet`) VALUES (1,'$receiver', '$refid', '$amount', '$ubalance', '$fwallet' )");
//                                                    mysqli_query($con,"INSERT INTO `charge`( `username`, `payment_ref`, `amount`, `iwallet`, `fwallet`, `description`) VALUES ('$receiver', 'Charge_$refid', '70', '$ubalance', '$fwallet', 'Being Charge For Fund Transfer' )");
//                                                          return;

                                                    $query=mysqli_query($con,"update wallet set balance=$amount+balance where username='$receiver'");
//                                                    $query=mysqli_query($con,"update wallet set balance=balance-70 where username='$receiver'");

                                                    $receiver=decryptdata($receiver);

                                                    $errormsg= "
<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Success : </br></strong>You have successfully Credited 
					 $amount to $receiver.</div>"; //printing error if found in validation

//                                            while($row = mysqli_fetch_array($result))
//                                            {
//                                                $emailm=$row['email'];
//                                            }

                                                    $query = mysqli_query($con,"SELECT * FROM  users where username = '$receiver'");
                                                    $result = mysqli_query($con,$query);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $username = $row["username"];
                                                        $name = $row["name"];
                                                        $email = $row["email"];
                                                    }
                                                    $query="SELECT * FROM deposit where username ='$receiver'";
                                                    $result = mysqli_query($con,$query);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $date = $row["date"];
                                                    }
                                                    $name=decryptdata($name);
                                                    $username=decryptdata($username);
                                                    $mail= "info@efemobilemoney.com";
                                                    $to = decryptdata($email);
                                                    $from = $mail;

                                                    $headers = "From: $from";
                                                    $headers = "From: " . $from . "\r\n";
                                                    $headers .= "Reply-To: ". $from . "\r\n";
                                                    $headers .= "MIME-Version: 1.0\r\n";
                                                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                                                    $subject = "$receiver|Account Funded | $refid";
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
                      <td style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:0px' align='center'><img src='https://rszomp.stripocdn.email/content/guids/CABINET_c2a5428bd0934f3fbd34e54cb3601b70/images/2471632219673694.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='100' height='30'></td> 
                     </tr> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:10px'>Account Fund By Admin<br></td> 
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
          <td style='padding:0;Margin:0;background-image:url(https://rszomp.stripocdn.email/content/guids/CABINET_c2a5428bd0934f3fbd34e54cb3601b70/images/32801632220122584.jpg);background-repeat:no-repeat;background-position:left top' background='https://rszomp.stripocdn.email/content/guids/CABINET_c2a5428bd0934f3fbd34e54cb3601b70/images/32801632220122584.jpg' align='center'> 
           <table class='es-content-body' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px'> 
             <tr> 
              <td align='left' style='Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:560px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr> 
                      <td class='es-m-p0r es-m-p0l' align='center' style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Dear $name,<br></p></td> 
                     </tr> 
                     <tr> 
                      <td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><span class='es-button-border' style='border-style:solid;border-color:#2CB543;background:#187b07;border-width:0px;display:inline-block;border-radius:5px;width:auto'><a href='' class='es-button' target='_blank' style='mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;border-style:solid;border-color:#187b07;border-width:10px 30px 10px 30px;display:inline-block;background:#187b07;border-radius:5px;font-family:arial, helvetica neue, helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center'>$name</a></span></td> 
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
                      <td align='left' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Customer: <strong>$name</strong></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Reference Number:&nbsp;<strong>Efe-$refid</strong><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Invoice date:&nbsp;<strong>$date</strong><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Payment method: <strong>Admin_Fund</strong><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Currency: <strong>NGN</strong><br></p></td> 
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
                      <td class='es-m-txt-l' align='left' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Amount Fund: <strong>NGN$amount</strong></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'>Email address: $email</p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica neue, helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px'><strong>Account Being Fund BY <br>Admin <br></strong></p></td> 
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
                      <td align='center' style='padding:0;Margin:0;padding-bottom:35px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:18px;color:#333333;font-size:12px'>4562 Hazy Panda Limits, Chair Crossing, If you have any questions/issues, please contact us at&nbsp;<a href='mailto:info@5starcompany.com.ng' target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#333333;font-size:12px'>info@</a>efemobilemoney.cpm<br>Thanks for choosing us</p></td> 
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

                                                }
                                                else
                                                {
                                                    $errormsg= "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-ban-circle'></i><strong>Error: </br></strong>".$msg."</div>"; //printing error if found in validation

                                                }
                                            }//end checking empty receiver;
                                        }//end general
                                        ?>
                                        <?php

                                        $query="SELECT * FROM  admin WHERE email='" . $_SESSION['email'] . "'";
                                        $result = mysqli_query($con,$query);
                                        $i=0;
                                        while($row = mysqli_fetch_array($result))
                                        {

                                            $pass="$row[password]";}
                                        ?>



                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">

                                            <div class="row">


                                                <div class="col-md-12">
                                                    <?php
                                                    if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status!=""))
                                                    {
                                                        print $errormsg;
                                                    }
                                                    ?>
                                                    <div class="form-group">
                                                        <label>Enter Receiver's Username</label>
                                                        <input type="text" class="form-control" id="email" name="receiver" placeholder="Enter Reveiver's Username" required />
                                                        <input type="hidden" name="todo" value="post">
                                                        <input type="hidden" class="form-control" value="<?php print $pass;?>" id="email" name="ccpass" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Enter Amount </label>
                                                        <input type="number" name="amount" class="form-control" placeholder="Amount to fund" required/>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Confirm Admin Password</label>
                                                        <input type="password" name="cpass" class="form-control" placeholder="Please enter administrative password" required/>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <input type="text" name="description" class="form-control" placeholder="Description (optional)"/>
                                                    </div>
                                                </div>

                                            </div>

                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" class="btn btn-rounded btn-outline-success btn-block">Fund Wallet</button>
                                            </form>
                                        </div>
                                    </div>


                                </div>


                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

