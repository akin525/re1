<?php include("menubar.php"); ?>

<?php
include_once ("include/database.php");


// Inialize session
//session_start();

//$query="SELECT * FROM  settings";
//$result = mysqli_query($con,$query);
//while($row = mysqli_fetch_array($result))
//{
//    $cur="$row[currency]";
//    $theme="$row[theme]";
//    $wlink=$row["wlink"];
//    $wname=$row["coname"];
//    $slogan=$row["slogan"];
//    $welcome_message=$row["welcome_message"];
//}


// Check, if username session is NOT set then this page will jump to login page
if (isset($_SESSION['username'])) {
    echo "<script language='javascript'>window.location = 'dashboard.php';</script>";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']))
{
// Collect the data from post method of form submission //
    $email=mysqli_real_escape_string($con,$_POST['email']);

    $query = "select * from users where email='$email'";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {

        $password=uniqid('m', true);

        $query=mysqli_query($con,"update users set password='".md5($password)."'  where email='".$email."'");

        // More headers
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <no-reply@'.$wlink.'>' . "\r\n";
//        $to=$email;
//        $subject="Password Reset on ".$wname;
//        $message = "Hello! <br /><p>Your Password has been reset with the details below. <br /> <br /> Password: $password. </p>Thanks for trying us out. <br /> https://".$wlink;
//
//        mail($email,$subject,$message,$headers);

        $msg= "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Password Reset Successful : </br></strong>A mail has been sent to $email containing your login details.</div>";

    }else{
        $msg= "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Email not found in our system</div>"; //printing error if found in validation
    }

}

?>
<!-- page-title area start -->
<div class="page-title-area mg-bottom-105 bref-bg" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <h3 class="title"> Forgetpassword </h3>
            </div>
            <div class="col-sm-6 text-center align-self-center">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="login.php">Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sign-up</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page-title area end -->
<div class="check-profit-area pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                    <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        print $msg;
                    }?>
                    <input type="hidden" name="_token" value="6KSM4J0Cbwlyqe2p7ZOCAXtAxJzTeRCudMFtBKFZ">                        <div class="title text-center">
                        <h5>Forget Password</h5>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="E-mail"  placeholder="Enter your email">
                        <input type="hidden" name="todo" value="post"></div>
                    <button type="submit" class="btn btn-success btn-block">Send Password Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include ("footer.php"); ?>
