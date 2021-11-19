<?php include "sidebar.php"; ?>
<div class="container-fluid">

    <!-- Title & Breadcrumbs-->
    <div class="row page-breadcrumbs">
        <div class="col-md-12 align-self-center">
            <h4 class="theme-cl">View Ticket</h4>
        </div>
    </div>
    <!-- Title & Breadcrumbs-->
    <?php
    $query="SELECT * FROM  users WHERE username='".$_SESSION['username']."'";
    $result = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($result))
    {
        $sender="$row[username]";
    }
    ?>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        $id = $_POST['id'];

        $query="SELECT * FROM  mail where  id = '$id'";
        $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($result))
        {
            $number="$row[number]";
            $subject="$row[subject]";
            $body="$row[message]";
            $date="$row[date]";
        }
    }
    ?>

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Date -->
                    <div class="form-group">
                        <label>Ticket ID:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-barcode"></i>
                            </div>
                            <input type="text" readonly class="form-control" value="<?php echo $number; ?>" class="form-control pull-right" id="datepicker">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- Date -->
                    <div class="form-group">
                        <label>Subject:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-edit"></i>
                            </div>
                            <input type="text" readonly class="form-control" value="<?php echo $subject; ?>" class="form-control pull-right" id="datepicker">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- Date -->
                    <div class="form-group">
                        <label>Date:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" readonly class="form-control" value="<?php echo $date ?>" class="form-control pull-right" id="datepicker">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->


                    <div class="form-group">
                        <label> Message Content</label>
                        <textarea  disabled id="compose-textarea" class="form-control" style="height: 300px">
									<?php echo $body; ?>
									</textarea>
                    </div>


                </div>

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
