<?php include"sidebar.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Collect the data from post method of form submission //
	$name = mysqli_real_escape_string($con, $_POST['name']);
	mysqli_query($con, "UPDATE `mg` SET `message`='$name'");
	
	print "
				<script language='javascript'>
				 let message = 'Update Successfully: ';
                                    alert(message);
window.location = 'message.php';
</script>
";

}
?>
<div style="padding:90px 15px 20px 15px">
<h4 class="align-content-center text-center">Update Notification</h4>
<div class="card">
<div class="card-body">
<div class="box w3-card-4"
<div class="row page-breadcrumbs">
<div class="col-md-12 align-self-center">
	</center>
	<form action="" method="post">
		<?php
		$query = "SELECT * FROM  `mg` ";
		$result = mysqli_query($con, $query);

		while ($row = mysqli_fetch_array($result)) {
			$mes = "$row[message]";

		}
		?>
		<div class="col-md-12">
			<div class="form-group">
				<label class="alert alert-primary">Notification</label>
				<input type="text" name="name" class="form-control" value="<?php echo $mes; ?>">
			</div>
		</div>

		<button type="submit" class="btn btn-rounded btn-outline-success btn-block">Update</button>
	</form>
</div>