<?php include "sidebar.php"; ?>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
<div class="col-md-12 align-self-center">
    <h4 class="theme-cl">All Users</h4>
</div>

<!-- Title & Breadcrumbs-->

<div class="row">
    <div class="col-md-12">
        <?php
        if(isset($_GET["username"])){
            $todelete= mysqli_real_escape_string($con,$_GET["username"]);

            $result=mysqli_query($con,"DELETE FROM users WHERE username='$todelete'");
        }
        ?>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Wallet Balance</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date</th>
<!--                        <th>Action</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query="SELECT * FROM users LEFT JOIN wallet on users.username = wallet.username";
                    $result = mysqli_query($con,$query);

                    while($row = mysqli_fetch_array($result))
                    {
//    return $row;
                        $username=$row["username"];
//    $picture=$row["profilepix"];
//    $status=$row["active"];
//    if($status==1)
//        $sta="Active";
//    if($status==1)
//        $color="success";
//    if ($status==2)
//        $sta="Blocked";
//    if($status==2)
//        $color="danger";
//    if ($status==0)
//        $sta="Inactive";
//    if($status==0)
//        $color="warning";
                        ?>
                        <tr>
                            <td><?php print decryptdata("$row[name]"); ?></td>
                            <td><?php print decryptdata($row["username"]); ?></td>
                            <td><?php print $row["balance"]; ?></td>
                            <td><?php print decryptdata($row["phone"]); ?></td>
                            <td><?php print decryptdata($row["email"]); ?></td>
                             <td><?php print $row["date"]; ?></td>
                            <!--        <td><div class="label cl---><?php // print $color ?><!-- bg---><?php //print $color; ?><!---light">--><?php //print $sta; ?><!--</div></td>-->
                              <td>
                                <a href="edituser.php?username=<?php print $row["username"]; ?>" class="settings" title="Settings" data-toggle="tooltip"><i class="mdi mdi-settings"></i></a>                              <a href="users.php?username=<?php print $row["username"]; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="mdi mdi-delete"></i></a>
</td>
                        </tr>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

