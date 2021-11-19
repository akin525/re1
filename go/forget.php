<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Efemobilemoney</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/logo2.png" />
</head>
<body>
<?php
include_once ("../include/database.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']))
{
// Collect the data from post method of form submission //
    $email=encryptdata(mysqli_real_escape_string($con,$_POST['email']));

    $query = "select * from users where email='$email'";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {

        $password=uniqid('m', true);

        $query=mysqli_query($con,"update users set password='".$password."'  where email='".$email."'");

        // More headers
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <no-reply@'.$wlink.'>' . "\r\n";
//        $to=$email;
//        $subject="Password Reset on ".$wname;
//        $message = "Hello! <br /><p>Your Password has been reset with the details below. <br /> <br /> Password: $password. </p>Thanks for trying us out. <br /> https://".$wlink;
//
//        mail($email,$subject,$message,$headers);

        $query="SELECT * FROM users where email = '".$_SESSION['login_user']."'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)) {


            $n = $row['name'];
            $email = $row['email'];
            $password = $row['password'];

        }
        $mail= "info@efemobilemoney.com";
        $to =decryptdata($email);
                $from = $mail;
                $name = $n;
//$subject = $_REQUEST['subject'];
//$number = $_REQUEST['phone_no'];
//$cmessage = $_REQUEST['message'];

                $headers = "From: $from";
                $headers = "From: " . $from . "\r\n";
                $headers .= "Reply-To: ". $from . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $subject = "From Efemobilemoney.";

                $logo = '<img src=https://efemobilemoney.com/assets/go/images/logo2.png alt=logo>';
                $link = '#';

                $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
                $body .= "<table style='width: 100%;'>";
                $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
                $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
                $body .= "<table role=presentation border=0 cellpadding=0 cellspacing=0 width=100%>
    <tr>
        <td style='padding: 20px 0 30px 0;'>

            <table align=center border=0 cellpadding=0 cellspacing=0 width=600 style='border-collapse: collapse;'>
                <tr>
                    <td align=center style='padding: 40px 0 30px 0;'>
                        <img src='https://efemobilemoney.com/go/assets/images/logo2.png' alt='logo' height='196' width=600 style='display: block;' />
                    </td>
                </tr>
                <tr>
                    <td bgcolor=#ffffff style='padding: 40px 30px 40px 30px;'>
                <table border=0 cellpadding=0 cellspacing=0 width=100% style='border-collapse: collapse;'>
                            <tr>
                                <td style='color: #153643; font-family: Arial, sans-serif;'>
                                    <h1 style='font-size: 24px; font-weight: 700; line-height: 32px; color: rgba(29, 21, 101, 1);'>Password Reset</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                    <p style='width: 536px; height: 24px; font-size: 18px; line-height: 28px; color: rgba(113, 110, 139, 1);'>Find <br/>Your reset Password Below</p>
                                </td>
                            </tr>

                            <tr>
                                <td style='color: #153643; font-family: Arial, sans-serif;'>
                                    <h1 style='font-style: normal; font-weight: bold; font-size: 28px; line-height: 28px; color: #0A072E; margin-top: 30px'>$password</h1>
                                </td>
                            </tr>

                            <tr>
                                <td style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                    <p style='width: 536px; height: 24px; font-size: 18px; line-height: 28px; color: rgba(113, 110, 139, 1);'>Here are a few tips to help secure your account:</p>

                                    <span style='width: 520px; font-size: 18px; line-height: 28px; color: rgba(113, 110, 139, 1);'>Never give your password to anyone.</span><br/>
         
                                    <span style='width: 520px; font-size: 18px; line-height: 28px; color: rgba(113, 110, 139, 1);'>Kindly Update Your Password after Log-in Your Profile</span><br/>
                                    <span style='width: 520px; font-size: 18px; line-height: 28px; color: rgba(113, 110, 139, 1);'></span><br/>
                                </td>
                            </tr>

                            <tr>
                                <td style='color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;'>
                                    <p style='font-size: 16px; line-height: 24px; color: rgba(113, 110, 139, 1);'>Regards,<br/>Efemobilemoney</p>
                                </td>
                            </tr>


                            <table bgcolor=#F2F2F2 border=0 cellpadding=0 cellspacing=0 width=100% style='border-collapse: collapse;'>
                                <tr>
                    
                                </tr>
                                <tr>
                                    <td>
                                       
                                    </td>
                                </tr>
                                <tr align=center>
                                
                            </tr>
                            </table>
                        </table>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>";
        
		$gb=decryptdata($email);
		 $send = mail($to, $subject, $body, $headers);

        $msg= "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Pass       word Reset Successful : </br></strong>A mail has been sent to $gb containing your login details.</div>";

    }else{
        $msg= "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Email not found in our system</div>"; //printing error if found in validation
    }

}


?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <button type="button" class="btn btn-outline-success"><a href="../index.php">Back To Homepage</a> </button>
                        <h3 class="card-title text-left mb-3">Forgetpassword</h3>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                        <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        print $msg;
                    }
                    ?>
                            <input type="hidden" name="_token" value="6KSM4J0Cbwlyqe2p7ZOCAXtAxJzTeRCudMFtBKFZ">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control p_input" required/>
                            <input type="hidden" name="todo" value="post">
                        </div>
                        <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block enter-btn">Get Password</button>
                            </div>
                    </form>
                    </div>
                </div>
                </div>
                </div>