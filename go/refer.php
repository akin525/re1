<?php include "sidebar.php"; ?>
<?php
$query="SELECT  sum(amount) FROM referal where username = '" . $_SESSION['username'] . "'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
{
    $refer=$row[0];


}
$query="SELECT * FROM users where username = '" . $_SESSION['username'] . "'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
{
    $username=$row["username"];


}
?>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">

<h4 class="btn btn-outline-success">profile</h4>
<br>
<br>

                    <li><span class="text-primary">Total Referral Bonus Amount: </span> <span class="text-blue"> NGN <?php echo number_format(intval($refer *1),2);?>
</span>
                    </li>
                    <li><span class="detail_left_part">Referral Name: </span> <span class="text-success"><?php echo decryptdata($username); ?></span>
                    </li>
<div class="card">
	<div class="card-body">
		<h6 class="text-white font-weight-bold">Your Referral Link</h6>
		<!-- The text field -->
		<input class="text-success form-control"  id="myInput" value=https://efemobilemoney.com/go/register.php?refer=<?php echo $username; ?> readonly/>
		<!-- The button used to copy the text -->
		<button onclick="myFunction()" class="btn badge-success">Copy Referral Link</button>
	</div>
</div>
<script>
	function myFunction() {
/* Get the text field */
var copyText = document.getElementById("myInput");

/* Select the text field */
copyText.select();
copyText.setSelectionRange(0, 99999); /* For mobile devices */

/* Copy the text inside the text field */
navigator.clipboard.writeText(copyText.value);

/* Alert the copied text */
alert("Copied the text: " + copyText.value);
}
</script>
<br>

<!-- referrals wrapper end -->
<!--  transactions wrapper start -->
                <br>
                <br>
                <h6 class="text-secondary">REFERRAL HISTORY</h6>
                <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <tfoot>
                    <thead>
                    <tr>
                        <th class="width_table1">Id</th>
                        <th class="width_table1">username</th>
                        <th class="width_table1">Referral</tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM referal WHERE username ='" . $_SESSION['username'] . "'";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($result)) { ?>

                        <tr>
                            <td><?php echo $row["id"] ; ?></td>
                            <td><?php echo decryptdata($row["username"]) ; ?></td>
                            <td><?php echo decryptdata($row["newuserid"]) ; ?></td>
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


