<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Efe Admin</title>
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

<?php include "include/database.php";
if (isset($_SESSION['username'])) {
    echo "<script language='javascript'>window.location = 'dashboard.php';</script>";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']))
{
// Collect the data from post method of form submission //
    $email=mysqli_real_escape_string($con,$_POST['email']);

    $query = "SELECT * FROM `admin` WHERE email='$email'";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {

        $password=uniqid('m', true);

        $query=mysqli_query($con,"update `admin` set password='".($password)."'  where email='".$email."'");

        // More headers
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <no-reply@'.$wlink.'>' . "\r\n";
//        $to=$email;
//        $subject="Password Reset on ".$wname;
//        $message = "Hello! <br /><p>Your Password has been reset with the details below. <br /> <br /> Password: $password. </p>Thanks for trying us out. <br /> https://".$wlink;
//
//        mail($email,$subject,$message,$headers);

        $query="SELECT * FROM `admin` where email = '".$_SESSION['login_user']."'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)) {


            $n = $row['name'];
            $email = $row['email'];
            $password = $row['password'];

        }
        $mail= "info@efemobilemoney.com";
        $to = $email;
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

        $subject = "From EFE MOBILE MONEY.";

        $logo = '<img src=public/images/logo/logo.png alt=logo>';
        $link = '#';

        $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
        $body .= "<table style='width: 100%;'>";
        $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
        $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
        $body .= "<p style='border:none;'><strong>Thanks For Signing Up, This Are Your Details Below<strong>";
        $body .= "<p style='border:none;'><strong>Your Password has been reset with the details below.</strong>Password: {$password} </p>";
        $body .= "<p style='border:none;'><strong>Kindly Update Your Password after Log-in Your Profile</strong></p>";
//$body .= "<p style='border:none;'><strong>Password:</strong> {$password}</p>";
//$body .= "<p style='border:none;'><strong>Wallet Balance:</strong>#0.00</p>";
        $body .= "</tr>";
// 	$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
        $body .= "<tr><td></td></tr>";
//$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
        $body .= "</tbody></table>";
        $body .= "</body></html>";

        $send = mail($to, $subject, $body, $headers);

        $msg= "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Password Reset Successful : </br></strong>A mail has been sent to $email containing your login details.</div>";

    }else{
        $msg= "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Email not found in our system</div>"; //printing error if found in validation
    }

}'[Q'

?>



<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-3">Forgot Password</h3>
                        <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                            print $msg;
                        } ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                            <div class="form-group">
                                <label>email *</label>
                                <input type="text" name="email" class="form-control p_input" required>
                                <input type="hidden" name="todo" value="post"></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block enter-btn">Recover</button>
                    <button type="button" class="btn btn-primary btn-block enter-btn"><a href="index.php" class="text-white">Back to login</a></button>
                            </div>
<!--                                                        <div class="d-flex">-->
<!--                                                            <button class="btn btn-facebook mr-2 col">-->
                            <!--                                    <i class="mdi mdi-facebook"></i> Facebook </button>-->
                            <!--                                <button class="btn btn-google col">-->
                            <!--                                    <i class="mdi mdi-google-plus"></i> Google plus </button>-->
                            <!--                            </div>-->
<!--                                                        <p class="sign-up">Back to login<a href="index.php">login</a></p>-->
                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
</body>
</html>