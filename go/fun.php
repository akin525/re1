<?php include "sidebar.php";
$todo= mysqli_real_escape_string($con,$_GET["amount"]);

?>
<div style="padding:90px 15px 20px 15px">
    <h4 class="align-content-center text-center">Fund Transfer</h4>
    <div class="card">
        <div class="card-body">
            <div class="box w3-card-4">
                <div class="row">
                    <div class="col-sm-8">
                        <br>
                        <br>
                        <div class="card">
                            <h5>Note:</h5>
                            <h5>1. Make sure you add payment method with your personal account details before making Transfer</h5>
                            <h6>2. Durring payment method, Enter the correct name being verify by the system in capital number to avoid auto credit delay</h6>
                            <h6>3. After you have add payment method successful you can now make transfer with the account to our account details showing below</h6>
                            <label class="fa-bold text-success">Kindly Add Payment Method Here</label>
                            <a href="method.php"> <button type="button" class="btn btn-outline-success">Add Payment Method</button></a>
                            <h6>4. it will be credit automatically if no error in payment method</h6>
                            <h6>5. if your account is not credit in the next 10min you can contact our support immediately. Tel:08035306324</h6>
                            <div class="card-body">
                                <?php $query="SELECT * FROM  paymentgateway where name='Bank Transfer' and status=1";


                                $result = mysqli_query($con,$query);

                                while($row = mysqli_fetch_array($result))
                                {
                                    $rave="$row[code]";
                                    $bank="$row[bank_name]";
                                    $acct=$row["account"];
                                    $name=$row["account_name"];
//$jp=$provider;
//return;
                                }


                                ?>
                                <!--                                    <div class="col-md-4 col-sm-6 mb-4">-->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <!--                                                    <div class="contact-info">-->
                                            <!--                                                        <div class="col-md-6 col-12">-->
                                            <div class="form-group">
                                                <label>Bank Name:</label>
                                                <b class="text-success fa-bold"><?php echo $bank; ?></b>
                                            </div>
                                        </div>
                                        <!--                                                        <div class="col-md-6 col-12">-->
                                        <div class="form-group">
                                            <label>Bank Account No:</label>
                                            <b class="text-success fa-bold"><?php echo $acct; ?></b>
                                        </div>
                                        <!--                                                        </div>-->
                                        <!--                                                        <div class="col-md-6 col-12">-->
                                        <div class="form-group">
                                            <label>Account Name:</label>
                                            <b class="text-success fa-bold"><?php echo $name; ?></b>
                                        </div>
                                        <!--                                                        </div>-->
                                        <!--                                                        <div class="col-md-6 col-12">-->
                                        <div class="form-group">
                                            <label>Amount </label>
                                            <b class="text-success fa-bold"><?php echo $todo; ?></b>

                                            <!--                    <b class="text-success fa-bold">--><?php //echo $provider; ?><!--</b>-->

                                        </div>
                                        <!--                                                        </div>-->
                                        <style>
                                            /* The Modal (background) */
                                            .modal {
                                                display: none; /* Hidden by default */
                                                position: fixed; /* Stay in place */
                                                z-index: 1; /* Sit on top */
                                                left: 0;
                                                top: 0;
                                                width: 100%auto; /* Full width */
                                                height: 100%auto; /* Full height */
                                                overflow: auto; /* Enable scroll if needed */
                                                background-color: rgb(255, 255, 255); /* Fallback color */
                                                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                                            }

                                            /* Modal Content/Box */
                                            .modal-content {
                                                background-color: #2ba316;
                                                margin: 15% auto; /* 15% from the top and centered */
                                                padding: 20px;
                                                border: 1px solid #226c14;
                                                width: 100%; /* Could be more or less, depending on screen size */
                                            }

                                            /* The Close Button */
                                            .close {
                                                color: #226c14;
                                                float: right;
                                                font-size: 28px;
                                                font-weight: bold;
                                            }

                                            .close:hover,
                                            .close:focus {
                                                color: #ffffff;
                                                text-decoration: none;
                                                cursor: pointer;
                                            }

                                        </style>

                                        <button  id="myBtn" class="btn btn-outline-primary btn-rounded">Kindly Contact Us After The Transfer For Reflection Of Transaction </a></button>
                                        <center>

                                            <div id="myModal" class="modal">

                                                <!-- Modal content -->
                                                <div class="page-wrapper">
                                                    <div class="modal-content">
                                                        <span class="close">&times;</span>
                                                        <p>Contact us on:08035306324/08146328645</p>
                                                        <div class="align-content-center">
                                                            <h6>OR</h6>
                                                            <span>Send The Receipt To info@efemobilemoney.com</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </center>
                                        <script>

                                            // Get the modal
                                            var modal = document.getElementById("myModal");

                                            // Get the button that opens the modal
                                            var btn = document.getElementById("myBtn");

                                            // Get the <span> element that closes the modal
                                            var span = document.getElementsByClassName("close")[0];

                                            // When the user clicks on the button, open the modal
                                            btn.onclick = function() {
                                                modal.style.display = "block";
                                            }

                                            // When the user clicks on <span> (x), close the modal
                                            span.onclick = function() {
                                                modal.style.display = "none";
                                            }

                                            // When the user clicks anywhere outside of the modal, close it
                                            window.onclick = function(event) {
                                                if (event.target == modal) {
                                                    modal.style.display = "none";
                                                }
                                            }
                                        </script>
                                    </div>


                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-rounded"><a href="dashboard.php"> Back To Homepage </a></button>

                        </div>
                    </div>
                </div>
