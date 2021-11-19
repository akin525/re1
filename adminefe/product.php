<?php include "sidebar.php"; ?>
<?php
if (isset($_GET["id"])) {
    $todelete= mysqli_real_escape_string($con,$_GET["id"]);

    $result=mysqli_query($con,"DELETE FROM products1 WHERE id='$todelete'");
}
?>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
        <!--                                        <h5 class="card-title">Deposit Transaction</h5>-->
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $query="SELECT * FROM products1";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($result))
                {
                    $status="$row[status]";
                    $id="$row[id]";
                    if($status==1)
                        $sta="Active";
                    if($status==1)
                        $color="success";
                    if ($status==0)
                        $sta="Inactive";
                    if($status==0)
                        $color="warning";
                    ?>
                    <tr>
                        <td><a href="#"><?php  print "$row[tittle]"; ?></a></td>
                        <td><?php  print "$row[name]"; ?></td>
                        <td><?php  print "$row[amount]"; ?></td>
                        <td><div class="label alert-<?php  print $color ?> alert<?php  print $color ?>"><?php  print $sta ?></div></td>
                        <td>
                            <a href="editproduct.php?id=<?php  print $id; ?>" class="settings" title="Settings" data-toggle="tooltip"><i class="mdi mdi-settings"></i></a>
                            <a href="product.php?id=<?php print $id; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="mdi mdi-delete"></i></a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.Table Card -->



</div>
</div>
<!-- /.row -->

</div>

<script src="assets/css/DataTables/datatables.min.js"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
</script>
<script>

