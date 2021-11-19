<?php include "sidebar.php"; 
$toupdate =  mysqli_real_escape_string($con,$_GET['username']);
?>
<div class="row">
<div class="col-md-12 align-self-center">
	<h4 class="theme-cl">Update Profile</h4>
</div>
<div class="col-md-12">
	<div class="card">
		<div class="row">
			<!-- col-md-6 -->
			<div class="col-md-12 col-12">

				<?php

				if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {

					$status="OK";
					// Collect the data from post method of form submission //
					$name=encryptdata(mysqli_real_escape_string($con,$_POST['name']));
					//                            $contr=mysqli_real_escape_string($con,$_POST['country']);
					$phone=encryptdata(mysqli_real_escape_string($con,$_POST['phone']));
					$email=encryptdata(mysqli_real_escape_string($con,$_POST['email']));
					$address=encryptdata(mysqli_real_escape_string($con,$_POST['address']));
					$userp=mysqli_real_escape_string($con,$_POST['username']);
					//                            $gender=mysqli_real_escape_string($con,$_POST['gender']);
					//                            $address=mysqli_real_escape_string($con,$_POST['address']);
					//collection ends

					$query3=mysqli_query($con,"update users set `name`='$name', phone='$phone',email='$email', address='$address' where username = '$userp'");

					echo $message = "Profile Update Successfully";
					print "
				<script language='javascript'>
				 let message = 'Profile Update Successfully: ';
                                    alert(message);
window.location = 'users.php';
</script>
";
				}
				?>

				<?php
				$query="SELECT * FROM  users where username='$toupdate' ";


				$result = mysqli_query($con,$query);
				$i=0;
				while ($row = mysqli_fetch_array($result)) {

					$flname="$row[name]";
					//$pict="$row[profilepix]";
					$add="$row[address]";
					//$cont="$row[country]";
					$mail="$row[email]";
					$cell="$row[phone]";
					//$sex="$row[gender]";
					//$withdraw="$row[allowwithdraw]";
					//$deposit="$row[allowdeposit]";
					//$purchase="$row[allowpurchase]";
					//$blocked="$row[blocked]";
				}

				
				?>



				<div class="col-md-12">


					<form action="edituser.php" method="post">

						<div class="col-md-12 col-12">
							<div class="form-group">
								<label>Full Name</label>
								<input type="text" name="name" class="form-control" value="<?php echo decryptdata($flname); ?>">
										</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" class="form-control" value="<?php echo decryptdata($mail); ?>">
								<input type="hidden" name="username" class="form-control" value="<?php echo $toupdate; ?>">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Phone</label>
								<input type="text" name="phone" class="form-control" value="<?php echo decryptdata($cell); ?>">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label>Address</label>
								<input type="text" name="address" class="form-control" value="<?php echo decryptdata($add); ?>">
							</div>
						</div>
						<br>

						
						<button type="submit" class="btn btn-rounded btn-outline-success btn-block">Update Account</button>
					</form>
					<p>
					</p>
				</div>

			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<!-- /.content-wrapper-->