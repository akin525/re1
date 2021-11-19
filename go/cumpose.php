<?php include "sidebar.php"; ?>
<div class="container-fluid">

    <!-- Title & Breadcrumbs-->
    <div class="row page-breadcrumbs">
        <div class="col-md-12 align-self-center">
            <h4 class="theme-cl">New Ticket</h4>
        </div>
    </div>
    <!-- Title & Breadcrumbs-->
    <?php
    $query="SELECT * FROM  users WHERE username='".$_SESSION['username']."'";
    $result = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($result))
    {
        $sender="$row[username]";
        $email=$row["email"];
    }
    ?>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        $number = $_POST['number'];
        $query=mysqli_query($con,"insert into mail (number,sender,subject,message,date) values('$number','$sender','$subject','$body',Now())");

        // More headers
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <no-reply@'.$wlink.'>' . "\r\n Reply-To: ".$email."\r\n";
//        $to=$wmail;
//        $subject="Ticket From ".$sender." on ".$wname;
//        $message = $body. " </p>-----------------. <br /> https://".$wlink;
//
//        mail($to,$subject,$message,$headers);

        echo "<div class='alert alert-success'>
  <strong>Success!</strong> Your ticket has been successfuly opened. We will get back to you in the shortest time possible.
</div>";
    }
    ?>

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label> Ticket ID</label>
                        <form method="post">
                            <?php $scode=rand(1111111111,9999999999); //generating random code, this will act as ticket id ?>
                            <input readonly name="number" class="form-control text-success" value="#<?php echo $scode ?>" placeholder="To:">
                    </div>

                    <div class="form-group">
                        <input class="form-control text-success" name="subject" placeholder="Subject:">
                    </div>

                    <div class="form-group">
									<textarea id="compose-textarea" name="body" class="form-control text-success" style="height: 300px">
									<h1><u>Ticket Heading</u></h1>
									<h4>Ticket Body</h4>
									<p>Your Content Goes Here</p>

									</textarea>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="box-footer padd-15">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default"><i class="mdi mdi-pencil"></i> Draft</button>
                        <button type="submit" class="btn btn-primary"><i class="mdi mdi-mail"></i> Send</button>
                    </div>
                    <button type="reset" class="btn btn-default"><i class="mdi mdi-timer"></i> Discard</button>
                </div>
                </form>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper-->



<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded cl-white theme-bg" href="#page-top">
    <i class="ti-angle-double-up"></i>
</a>

<script src="assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
<script>
    $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
    });
</script>