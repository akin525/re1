<?php include "sidebar.php"; ?>
<div style="padding:90px 15px 20px 15px">
    <h4 class="align-content-center text-center">Withdraw Commission</h4>
    <div class="card">
        <div class="card-body">
            <div class="box w3-card-4"
            <div class="row page-breadcrumbs">
                <div class="col-md-12 align-self-center">
                    <!--            <h4 class="theme-cl">Update Profile</h4>-->
                </div>
            </div>
            <!-- Title & Breadcrumbs-->

            <?php

            if($_SERVER['REQUEST_METHOD'] == 'POST' )
            {

                $status="OK";
// Collect the data from post method of form submission //
                $amount=mysqli_real_escape_string($con,$_POST['amount']);
//                                            $contr=mysqli_real_escape_string($con,$_POST['country']);
                $bank=mysqli_real_escape_string($con,$_POST['value']);
                $number=mysqli_real_escape_string($con,$_POST['number']);
                $num=mysqli_real_escape_string($con,$_POST['full']);
                echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-ban-circle'></i><strong>Success : </br></strong>Request Sent</div>"; //printing error if found in validation

            }

            ?>

            <?php
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/bank",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer sk_test_280c68e08f76233b476038f04d92896b4749eec3",
                    "Cache-Control: no-cache",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
//    echo $response;
            }
            $data = json_decode($response, true);
            $success = $data["status"];
            foreach($data['data'] as $plans){
//    echo $plans['name'];
//    echo $plans['code'];
            }

            //echo $networkcode . " ". $number;

            ?>

            <div class="change_pass_field float_left">
                <form action="miss.php" method="post">
                    <script>
                        function shoUser() {
                            var str= document.getElementById("tvphone1").value;
                            var k= document.getElementById("value").value;

                            if (str == "") {
                                document.getElementById("vtv1").innerHTML = "IUC cannot be empty";
                                document.getElementById("btnd1").removeAttribute("disabled");
                                return;
                            } else if (str.length<9) {
                                document.getElementById("vtv1").innerHTML = "IUC is too short";
                                document.getElementById("btnd1").removeAttribute("disabled");
                                return;
                            } else {
                                document.getElementById("btnv1").innerText="Verify....";
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("btnv1").innerText="Verify";
                                        if(this.responseText=="fail"){
                                            document.getElementById("vtv1").innerHTML = "Error validating IUC Number";
                                            document.getElementById("btnd1").setAttribute("disabled", "true");
                                        }else{
                                            document.getElementById("vtv1").innerHTML = this.responseText;
                                            document.getElementById("btnd1").removeAttribute("disabled");
                                        }
                                    }
                                };
                                xmlhttp.open("GET","verifybill.php?number="+str+"+&networkcode="+k,true);
                                xmlhttp.send();
                            }
                        }
                    </script>

                    <div class="subscribe-area">
                        <label>Enter Amount</label>
                        <input  type="number" name="amount" class="form-control" required/>
                        <!--                                            <b class="text-success fa-bold" id="vtv1"></b>-->
                    </div>
                    <div class="payment_gateway_wrapper payment_select_wrapper">
                        <label>Select Your Bank :</label>
                        <select data-required="true" class="form-control" id="value" name="value" required>

                            <option selected>choose Bank Name</option>
                            <?php
                            foreach($data['data'] as $plans){
                                ?>
                                <option value="<?php echo $plans['code']; ?>" id="<?php echo $plans['name']; ?>"><?php echo $plans['name']; ?></option>
                            <?php } ?>
                        </select>

                        <!--                                            onchange="document.getElementById('hello').value=this.is"-->
                        <!--                                            <input type="text" id="hello" name="" value="">-->
                    </div>
                    <div class="form-group">
                        <label>Account Number :</label>
                        <input  type="tel" id="tvphone1" name="number"><button id="btnv1" type="button" onclick="shoUser()">Verify</button>
                        <b class="text-success fa-bold" id="vtv1"></b>
                    </div>
                    <div class="form-group">
                        <label>Reselect Bank:</label>
                        <select data-required="true" class="form-control" id="value" name="full" required>

                            <option selected>choose Bank Name</option>
                            <?php
                            foreach($data['data'] as $plans){
                                ?>
                                <option value="<?php echo $plans['name']; ?>" id="<?php echo $plans['name']; ?>"><?php echo $plans['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Enter Verify Name</label>
                        <input  type="text" name="full" class="form-control" placeholder="Please Enter The Name Display After Very Account No" required/>
                        <!--                                            <b class="text-success fa-bold" id="vtv1"></b>-->
                    </div>
                    <?php
                    $query="SELECT * FROM  admin WHERE username ='" . $_SESSION['email'] . "'";
                    $result = mysqli_query($con,$query);

                    while($row = mysqli_fetch_array($result))
                    {
                        $user="$row[username]";
                    }
                    ?>
                    <div class="change_field">
                        <input type="hidden" name="username" value="<?php echo $user; ?>">
                    </div>
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Withdraw</button>
                </form>
            </div>
        </div>
    </div>

