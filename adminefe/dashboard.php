<?php include "sidebar.php"; ?>
<?php //include "include/session.php"; ?>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card corona-gradient-card">
            <div class="card-body py-0 px-0 px-sm-3">
                <div class="row align-items-center">
                    <div class="col-4 col-sm-3 col-xl-2">
                        <img src="assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                    </div>
                    <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Efe Admin Dashboard</h4>
                        <p class="mb-0 font-weight-normal d-none d-sm-block">SAVE SMART, SAVE SECURELY, SAVE REGULARLY!</p>
                    </div>
                    <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        <span>
                          <a href="credit.php" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Credit User</a>
                        </span>
                        <span>
                          <a href="refund.php" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Refund User</a>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">NGN <?php echo number_format(intval($balance *1),2);?></h3>
                            <!--                            <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>-->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-wallet"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">All Savings Balance</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">NGN<?php echo number_format(intval($lock *1),2); ?></h3>
                            <!--                            <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>-->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-lock"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">All Lock Balance</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">NGN<?php echo number_format(intval($deposited *1),2);?></h3>
                            <!--                            <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>-->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger">
                            <span class="mdi mdi-wallet"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">All Deposits</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <?php
                            $query = "SELECT * FROM  paymentgateway where name='MCD Token'";

                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $token = $row["code"];
                            }


                            $query="SELECT * FROM `admin` where email ='" . $_SESSION['email'] . "'";
                            $result = mysqli_query($con,$query);
                            while($row = mysqli_fetch_array($result))
                            {
                                $payer="$row[username]";
//                                $p=$row["phone"];
                            }
                            $resellerURL='https://app.mcd.5starcompany.com.ng/api/reseller/';

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'https://test.mcd.5starcompany.com.ng/api/reseller/me',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_SSL_VERIFYHOST => 0,
                                CURLOPT_SSL_VERIFYPEER => 0,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => array('service' => 'balance'),
                                CURLOPT_HTTPHEADER => array(
                                    'Authorization: MCDKEY_903sfjfi0ad833mk8537dhc03kbs120r0h9a'
                                ),
                            ));

                            $response = curl_exec($curl);

                            curl_close($curl);
//                                                    echo $response;
                            $data=json_decode($response, true);
                            $success=$data["success"];
                            $tran=$data["data"]["wallet"];
                            $pa=$data["data"]["commission"];
                            if($success==1){
                                                        ?>
                            <h3 class="mb-0">NGN<?php echo number_format(intval($tran *1),2);?></h3>
                            <?php }else{ ?>
                                <h6 class="text-white">NGN0.00</h6>

                            <?php } ?>
<!--                                                        <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>-->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-wallet"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">MCD Balance</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-xl-4 col-sm-6 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-9">
					<div class="d-flex align-items-center align-self-start">
						<?php
						$result = mysqli_query($con,"SELECT count(*) FROM  users");
						$row = mysqli_fetch_row($result);
						$numrows = $row[0];

						?>
						<h3 class="mb-0"><?php echo $numrows ; ?> Users</h3>
						<!--                            <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>-->
					</div>
				</div>
				<div class="col-3">
					<div class="icon icon-box-success ">
						<span class="mdi mdi-account"></span>
					</div>
				</div>
			</div>
			<h6 class="text-muted font-weight-normal">Total Users</h6>
		</div>
	</div>
</div>
<div class="col-xl-4 col-sm-6 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-9">
					<div class="d-flex align-items-center align-self-start">
						<h3 class="mb-0">NGN<?php echo number_format(intval($pa *1),2); ?></h3>
						<!--                            <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>-->
					</div>
				</div>
				<div class="col-3">
					<div class="icon icon-box-success">
						<span class="mdi mdi-wallet"></span>
					</div>
				</div>
			</div>
			<h6 class="text-muted font-weight-normal">MCD Commission</h6>
		</div>
	</div>
</div>
<div class="col-xl-4 col-sm-6 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-9">
					<div class="d-flex align-items-center align-self-start">
						<?php
						$result = mysqli_query($con,"SELECT sum(amount) FROM  bill_payment ");
						$row = mysqli_fetch_row($result);
						$total = $row[0];
						?>
						<h3 class="mb-0">NGN<?php echo number_format(intval($total *1),2); ?></h3>
						<!--                            <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>-->
					</div>
				</div>
				<div class="col-3">
					<div class="icon icon-box-danger">
						<span class="mdi mdi-wallet"></span>
					</div>
				</div>
			</div>
			<h6 class="text-muted font-weight-normal">Total Bills</h6>
		</div>
	</div>
</div>
</div>
 <div class="card">
<div class="card-body">
<center>
    <a href="witho.php"> <button class="btn btn-outline-primary">Withdraw Your Commission</button></a>
</center>
</div>
</div>
<br>
<div class="row">
    <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <?php
                            $result = mysqli_query($con,"SELECT sum(amount) FROM  charge where status=1");
                            $row = mysqli_fetch_row($result);
                            $total11 = $row[0];
                            ?>

                            <h3 class="mb-0">NGN<?php echo number_format(intval($total11 *1),2); ?></h3>
                            <!--                            <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>-->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-wallet"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Charges</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
        <?php
        $result = mysqli_query($con,"SELECT sum(amount) FROM  withdraw ");
        $row = mysqli_fetch_row($result);
        $total12 = $row[0];
        ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">NGN<?php echo number_format(intval($total12 *1),2); ?></h3>
                            <!--                            <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>-->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-wallet"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Withdraw</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <?php
                            $result = mysqli_query($con,"SELECT sum(discountamount) FROM  bill_payment ");
                            $row = mysqli_fetch_row($result);
                            $total13 = $row[0];
                            ?>
                            <h3 class="mb-0">NGN<?php echo number_format(intval($total13 *1),2); ?></h3>
                            <!--                            <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>-->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger">
                            <span class="mdi mdi-wallet"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Discount</h6>
            </div>
        </div>
    </div>
</div>

<?php
$result = mysqli_query($con,"SELECT count(*) FROM  products1");
$row = mysqli_fetch_row($result);
$products = $row[0];

?>

<?php
$result = mysqli_query($con,"SELECT count(*) FROM  bill_payment");
$row = mysqli_fetch_row($result);
$soldproducts = $row[0];

?>


<?php
$result = mysqli_query($con,"SELECT sum(amount) FROM  bill_payment where status=1");
$row = mysqli_fetch_row($result);
$total = $row[0];
?>

<?php
$result = mysqli_query($con,"SELECT sum(amount) FROM  deposit where status=1");
$row = mysqli_fetch_row($result);
$deposits = $row[0];
?>


<?php
$result = mysqli_query($con,"SELECT sum(amount) FROM  bill_payment where status=0 or status=2");
$row = mysqli_fetch_row($result);
$pending = $row[0];
?>

<div class="row">

    <!-- Bar Chart -->
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Payments Chart</h4>
            </div>
            <div class="card-body">
                <canvas id="bar-chart" width="800" height="450"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart Horizental -->
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Customer's Chart</h4>
            </div>
            <div class="card-body">
                <canvas id="bar-chart-horizontal" width="800" height="450"></canvas>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

            </div>
        </div>
    </div>

</div>
<!-- /.row -->
<br>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
     <!--           <button type="button" class="btn btn-outline-success">-->
					<!--<a href="tp.php"class="text-white">test credit</a></button>-->
                <h4 class="card-title">All Deposit History</h4>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>
                                <div class="form-check form-check-muted m-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input">
                                    </label>
                                </div>
                            </th>
                            <th> Username </th>
                            <th> Transaction Id </th>
                            <th> Date</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM deposit order by date desc limit 5";
                        $result = mysqli_query($con,$query);
                        while($row = mysqli_fetch_array($result)) { ?>

                            <tr>
                                <td>
                                    <div class="form-check form-check-muted m-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">
                                        </label>
                                    </div>
                                </td>
                                <td><?php echo decryptdata($row["username"]) ; ?></td>
                                <td><?php echo $row["payment_ref"] ; ?></td>
                                <td><?php echo $row["date"] ; ?></td>
                                <td>NGN.<?php echo $row ["amount"] ; ?></td>
                            </tr>
                            <?php
                        }
                        ?>



                        </tbody>
                    </table>
                    <button class="btn btn-outline-success align-content-center"><a href="history.php"> See More Deposite</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
 <div class="card-body">
    <form method="POST">
        <label class="text-success">From: </label> <input type="date" class="text-success"  name="from">
        <label class="text-success" >To: </label> <input type="date" class="text-success" name="to">
        <input type="submit" class="text-success" value="Get Data" name="submit">
    </form>
<h6 class="text-success">Data Between Selected Dates</h6>

         <div>
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped table-bordered">
            <thead>
        <th class="table-active"> Username </th>
        <th> Transaction Id </th>
        <th> Date</th>
        <th>Amount</th>
        </thead>
        <tbody>
        <?php
        if (isset($_POST['submit'])){
            $from=date('Y-m-d H:i:s',strtotime($_POST['from']." 00:00:00"));
            $to=date('Y-m-d H:i:s',strtotime($_POST['to']." 11:59:59"));


            $query="select * from `deposit`  where date BETWEEN '$from' and '$to'";
            $result = mysqli_query($con,$query);
            while($row = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo decryptdata($row["username"]) ; ?></td>
                    <td><?php echo $row["payment_ref"] ; ?></td>
                    <td><?php echo $row["date"] ; ?></td>
                    <td>NGN.<?php echo $row ["amount"] ; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <center>
            <?php
            $tot=0;

            $re = mysqli_query($con,"select  sum(amount)  from `deposit` where date BETWEEN '$from' and '$to'");
            $row = mysqli_fetch_row($re);
            $tot = $row[0];

            ?>
            <button type="button" class="align-content-center btn btn-outline-success text-center">Total =NGN<?php echo number_format(intval($tot *1),2); ?></button>
        </center>
        </tbody>
    </table>
<!--    --><?php //echo $from; ?>
<!--    --><?php //echo $to; ?>
    </div>
</div>
</div>
</div>
<br>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <!--           <button type="button" class="btn btn-outline-success">-->
                <!--<a href="tp.php"class="text-white">test credit</a></button>-->
                <h4 class="card-title">All Charges History</h4>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>
                                <div class="form-check form-check-muted m-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input">
                                    </label>
                                </div>
                            </th>
                            <th> Username </th>
                            <th> Transaction Id </th>
                            <th> Date</th>
                            <th>Amount Charge</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM charge order by date desc limit 5";
                        $result = mysqli_query($con,$query);
                        while($row = mysqli_fetch_array($result)) { ?>

                            <tr>
                                <td>
                                    <div class="form-check form-check-muted m-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">
                                        </label>
                                    </div>
                                </td>
                                <td><?php echo decryptdata($row["username"]) ; ?></td>
                                <td><?php echo $row["payment_ref"] ; ?></td>
                                <td><?php echo $row["date"] ; ?></td>
                                <td>NGN.<?php echo $row ["amount"] ; ?></td>
                                <td><?php echo $row ["description"] ; ?></td>
                            </tr>
                            <?php
                        }
                        ?>



                        </tbody>
                    </table>
                    <button class="btn btn-outline-success align-content-center"><a href="ch.php"> See More Deposite</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        "use strict";
        // Bar chart
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: ["Total Sales", "Pending", "Deposits"],
                datasets: [
                    {
                        label: "Population (millions)",
                        backgroundColor: ["#03a9f4", "#e861ff","#08ccce"],
                        data: [<?php echo $total; ?>,<?php echo $pending; ?>,<?php echo $deposits; ?>]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'System Payment Chart'
                }
            }
        });


        // line second
    });
</script>

<script>
    // Horizental Bar Chart
    new Chart(document.getElementById("bar-chart-horizontal"), {
        type: 'horizontalBar',
        data: {
            labels: ["All Users", "Active Users"],
            datasets: [
                {
                    label: "Total Users",
                    backgroundColor: ["#0000FF","#00FF00"],
                    data: [<?php echo $numrows; ?>,<?php echo $numrows; ?>]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'System Customers Chart'
            }
        }
    });
</script>
<script src="assets/chart.js/Chart.bundle.js"></script>
<script src="assets/chart.js/Chart.js"></script>