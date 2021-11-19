<?php include "sidebar.php"; ?>
<div class="card">
    <div class="card-body">
        <h6 class="align-content-center text-secondary">Deposit Transactions</h6>
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


                        $query="select * from `deposit` where date BETWEEN '$from' and '$to'";
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



<div class="card">
    <div class="card-body">
        <h6 class="align-content-center text-secondary">Bills Transactions</h6>
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


                        $query="select * from `deposit` where date BETWEEN '$from' and '$to'";
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

                        $re = mysqli_query($con,"select  sum(amount)  from `bill_payment` where timestamp BETWEEN '$from' and '$to'");
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

