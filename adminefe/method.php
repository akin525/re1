<?php include "sidebar.php"; ?>
<?php
if (isset($_GET["id"])) {

    $todelete= mysqli_real_escape_string($con,$_GET["id"]);

    $result=mysqli_query($con,"DELETE FROM users WHERE id='$todelete'");

}

?>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
            <h5>User Bank Method</h5>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input type="checkbox" value="" id="checkAll">
                            <label  for="checkAll">
                            </label>
                        </div>
                    </th>
                    <!--        <th>ID </th>-->
                    <th>Username</th>
                    <!--        <th>Lock-Balance</th>-->
                    <th>Bank Name</th>
                    <th>Account No</th>
                    <!--        <th>Withdraw Date</th>-->
                </tr>
                </thead>
                <?php
                $query="SELECT * FROM banks";
                $result = mysqli_query($con,$query);
                while($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" value="" id="flexCheckDefault2">
                                <label for="flexCheckDefault2">
                                </label>
                            </div>
                        </td>
                        <!--        <td><span class="text-black font-w500">--><?php //echo $row["ID"] ; ?><!--</span></td>-->
                        <td><?php echo decryptdata($row["username"]) ; ?></td>
                        <!--        <td><span class="text-black">--><?php //echo number_format(intval( $row["balance"] *1),2); ?><!--</span></td>-->
                        <?php
                        $code=0;
                        $nu=0;
                        $code=$row["bank_name"];
                        $nu=$row["account_no"];


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
                        <td><?php echo $code ; ?></td>
                        <!--        <td class="fs-16 text-black font-w600 mb-0 text-nowrap">--><?php //echo $row["bank_name"] ; ?><!--</td>-->
                        <td><?php echo $row["account_no"] ; ?></td>
                    </tr>
                    <?php
                }
                ?>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>