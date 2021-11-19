<?php require 'sidebar.php'; ?>
    <!--    <div style="padding:90px 15px 20px 15px">-->
    <h4 class="align-content-center text-center">Commission</h4>
    <div class="card">
        <div class="card-body">
            <div class="box w3-card-4"
            <div class="row page-breadcrumbs">
                <div class="col-md-12 align-self-center">

                    <?php
                    $query = "SELECT * FROM  paymentgateway where name='MCD Token'";

                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $token = $row["code"];
                    }
                    $amount=intval(mysqli_real_escape_string($con,$_POST['amount']));
                    $bank=mysqli_real_escape_string($con,$_POST['value']);
                    $number=mysqli_real_escape_string($con,$_POST['number']);
                    $name=mysqli_real_escape_string($con,$_POST['full']);
                    $resellerURL='https://app.mcd.5starcompany.com.ng/api/reseller/';


                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $resellerURL.'me',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('service' => 'withdraw_commission','amount' => $amount,'account_number' => $number,'bank_code' => $bank,'bank' => $name,'wallet' => 'Wallet'),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: '.$token
                        ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    echo $response;
                    //echo $amount;
                    $data = json_decode($response, true);
                    $success = $data["success"];
                    $tran = $data["message"];
                    //echo $tran;
                    ?>
                    <?php if($success=="1"){
                        echo    "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-ban-circle'></i><strong>Success : </br></strong>$tran</div>" ?>
                    <?php }if($success=="0") {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-ban-circle'></i><strong>Error: </br></strong>$tran</div>" ?>
                    <?php } ?>
                    <button type="button" class="btn-outline-success"><a class="align-content-center" href ="dashboard.php">Back To Homepage</a></button>





