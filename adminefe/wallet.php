<?php include "sidebar.php"; ?>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users Wallet</h4>
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
                            <th> Balance</th>
<!--                            <th> Date</th>-->
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM wallet";
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
                                <td><?php echo $row["balance"] ; ?></td>
<!--                                <td>--><?php //echo $row["date"] ; ?><!--</td>-->
                                <td><button type="button" class="btn-outline-success"><a href="credit.php">Credit User</a> </button> </td>
                            </tr>
                            <?php
                        }
                        ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

