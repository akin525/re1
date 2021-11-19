<?php include "sidebar.php"; ?>

<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
<h4 class="theme-cl">All Users Request</h4>
<!-- Title & Breadcrumbs-->
<h6 class="align-content-center text-center">Notice: That Transfer Must Av Been Done Before Approval</h6>
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Bank</th>
                <th>Account-No</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query="SELECT * FROM withdraw ";
            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_array($result))
            {
//    return $row;
//                                            $username=$row["username"];
                $code=$row["bank"];

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
                    <td><?php print decryptdata($row["username"]); ?></td>
                    <td><?php print $row["name"]; ?></td>
                    <td><?php print $row["amount"]; ?></td>
                    <?php
                    $code=0;
                    $nu=0;
                    $code=$row["bank"];
                    //                                                $nu=$row["account_no"];


                    If($code=='1'){
                        $code= 'Access Bank';
                    }
                    if($code=='050'){
                        $code= 'EcoBank Nigeria PLC';
                    }
                    if($code=='3'){
                        $code=  'Fidelity Bank PLC';
                    }
                    if($code=='011'){
                        $code=  'First Bank of Nigeria PLC';
                    }
                    if($code=='058'){
                        $code= 'Guaranty Trust Bank PLC';
                    }
                    if($code=='6'){
                        $code= 'Unity Bank PLC';
                    }
                    if($code=='7'){
                        $code=  'United Bank for Africa';
                    }
                    if($code==8){
                        $code=  'Union Bank of Nigeria PLC';
                    }
                    if($code=='232'){
                        $code=  'Sterling Bank PLC';
                    }
                    if($code=='221'){
                        $code= 'Stanbic IBTC Bank PLC';
                    }
                    if($code=='101'){
                        $code=  'Providus Bank Limited';
                    }
                    if($code=='035'){
                        $code= 'Wema Bank PLC';
                    }
                    if($code=='057'){
                        $code=  'Zenith Bank PLC';
                    }
                    if($code=='076'){
                        $code=  'Polaris Bank Ltd';
                    }
                    ?>
                    <td><?php print $code; ?></td>
                    <td><?php print $row["account_no"]; ?></td>
                    <!--        <td><div class="label cl---><?php // print $color ?><!-- bg---><?php //print $color; ?><!---light">--><?php //print $sta; ?><!--</div></td>-->
                    <td>
                        <?php
                        if($row["status"]==0){
                        ?>
                        <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST' )
                        {

                            $status="OK";
                            $name=mysqli_real_escape_string($con,$_POST['app']);
                            $id=mysqli_real_escape_string($con,$_POST['id']);

                            mysqli_query($con, "UPDATE `withdraw` SET `status` = '$name' WHERE `withdraw`.`id` = $id;");

                            print "
                    <script language='javascript'>
                     let message = 'Withdraw Successfully Approved';
                                    alert(message);
                                  
                        window.location = 'request1.php';
                    </script>
                    ";
                        }
                        ?>
                        <form action="request1.php" method="post">
                            <input type="hidden" name="app" value="1">
                            <input type="hidden" name="id" value="<?php print $row["id"]; ?>"/>
                            <button type="submit" class="btn btn-outline-success">Approve</button>

                            <?php }else{ ?>
                                <button class="md1 mdi-approval" title="click to approved" data-toggle="tooltip"><i class="fa-star-half-empty fa"></i>Withdraw Complete</button>
                            <?php } ?>
                    </td>
                    </form>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
</div>
</div>


