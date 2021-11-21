<?php include"sidebar.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the data from post method of form submission //
    $name = mysqli_real_escape_string($con, $_POST['ok']);
    mysqli_query($con, "UPDATE `settings` SET `maintain`='$name'");

    print "
				<script language='javascript'>
				 let message = 'Update Successfully: ';
                                    alert(message);
window.location = 'okp.php';
</script>
";

}
?>
<div style="padding:90px 15px 20px 15px">
    <h4 class="align-content-center text-center">Update Notification</h4>
    <div class="card">
        <div class="card-body">
            <div class="box w3-card-4"
            <div class="row page-breadcrumbs">
                <div class="col-md-12 align-self-center">
                    </center>
                    <form action="" method="post">
                        <?php
                        $query = "SELECT * FROM settings";
                        $result = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_array($result)) {
                            $pk = "$row[maintain]";

                        }
                        ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="alert alert-primary">Off/On Website</label>
                                <select name="ok" class="text-success form-control" required="">
                                    <option value="0">off</option>
                                    <option value="1">on</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-rounded btn-outline-success btn-block">Update</button>
                    </form>
                </div>