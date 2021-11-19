<?php include "include/database.php"; ?>
<?php
if (!isset($_SESSION['email'])) {
    print "
<script>
    window.location = 'index.php';
</script>
";
}


$result = mysqli_query($con,"SELECT sum(balance) FROM  wallet ");
$row = mysqli_fetch_row($result);
$balance= $row[0];

$query="SELECT * FROM  userbvn";
//$result = mysqli_query($con,$query);
$bvn=0;
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
{
    $bvn=$row["bvn"];
}
$depositor=0;
$iwallet=0;
$query="SELECT * FROM deposit";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
{
    $depositor=$row["amount"];
    $iwallet=$row["iwallet"];

}
?>

<?php
$result = mysqli_query($con,"SELECT sum(amount) FROM  deposit");
$row = mysqli_fetch_row($result);
$deposited = $row[0];

?>
<?php
$query="SELECT  sum(amount) FROM referal";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
{
    $refer=$row[0];


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Efe Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/logo2.png" />
</head>
<?php

$lock=0;
$query="SELECT  sum(balance) FROM safe_lock";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result)) {
    $lock = $row[0];
    $da = $row["date"];
}

$query="SELECT * FROM `admin` WHERE email='" . $_SESSION['email'] . "'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result)) {
    $date = $row["date"];
    $username=$row["username"];
    $name=$row["name"];
    $email=$row["email"];
}
?>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="dashboard.php"><img src="assets/images/logo2.png" alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="dashboard.php"><img src="assets/images/logo2.png" alt="logo" /></a>
        </div>
        <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                            <img class="img-xs rounded-circle " src="assets/images/user.png" alt="">
                            <span class="count bg-success"></span>
                        </div>
                        <div class="profile-name">
                            <h5 class="mb-0 font-weight-normal"><?php echo ($username); ?></h5>
                            <span><?php echo ($name); ?></span>
                        </div>
                    </div>
                    <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                        <a href="profile.php" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-primary"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="pass.php" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-onepassword  text-info"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-calendar-today text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="dashboard.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="ph.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                    <span class="menu-title">Transaction Daily</span>
                </a>
            </li>

            <li class="nav-item menu-items">
				<a class="nav-link" href="message.php">
					<span class="menu-icon">
						<i class="mdi mdi-notification-clear-all"></i>
					</span>
					<span class="menu-title">Notification</span>
				</a>
			</li>
    <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                    <span class="menu-title">Posts</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic1">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="manage-posts.php">All Posts</a></li>
                        <li class="nav-item"> <a class="nav-link" href="add-post.php">Add Post</a></li>
<!--                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>-->
                    </ul>
                </div>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-account-card-details"></i>
              </span>
                    <span class="menu-title">Category</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="manage-category.php">All Category</a></li>
                        <li class="nav-item"> <a class="nav-link" href="add-category.php">Add Category</a></li>
                        <!--                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>-->
                    </ul>
                </div>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="wallet.php">
              <span class="menu-icon">
                <i class="mdi mdi-wallet"></i>
              </span>
                    <span class="menu-title">All-Wallet</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="lock.php">
              <span class="menu-icon">
                <i class="mdi mdi-wallet"></i>
              </span>
                    <span class="menu-title">Lock-Wallet</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="gateway.php">
              <span class="menu-icon">
                <i class="mdi mdi-wallet"></i>
              </span>
                    <span class="menu-title">Gateway</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="request1.php">
              <span class="menu-icon">
                <i class="mdi mdi-receipt"></i>
              </span>
                    <span class="menu-title">Withdraw Request</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="request2.php">
              <span class="menu-icon">
                <i class="mdi mdi-receipt"></i>
              </span>
                    <span class="menu-title">Transfer Request</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="charges.php">
              <span class="menu-icon">
                <i class="mdi mdi-receipt"></i>
              </span>
                    <span class="menu-title">Charge User</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="method.php">
              <span class="menu-icon">
                <i class="mdi mdi-contactless-payment"></i>
              </span>
                    <span class="menu-title">User Paymentmethod</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="product.php">
              <span class="menu-icon">
                <i class="mdi mdi-cart"></i>
              </span>
                    <span class="menu-title">Data Product</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="history.php">
              <span class="menu-icon">
                <i class="mdi mdi-history"></i>
              </span>
                    <span class="menu-title">Deposit History</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="bvn.php">
              <span class="menu-icon">
                <i class="mdi mdi-lamp"></i>
              </span>
                    <span class="menu-title">User Bvn</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="#">
              <span class="menu-icon">
                <i class="mdi mdi-code-brackets"></i>
              </span>
                    <span class="menu-title">Referrals</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="bill.php">
              <span class="menu-icon">
                <i class="mdi mdi-wallet"></i>
              </span>
                    <span class="menu-title">All Bills</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="users.php">
              <span class="menu-icon">
                <i class="mdi mdi-wallet-giftcard"></i>
              </span>
                    <span class="menu-title">All Users</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="create.php">
              <span class="menu-icon">
                <i class="mdi mdi-wallet-giftcard"></i>
              </span>
                    <span class="menu-title">Create User</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="profile.php">
              <span class="menu-icon">
                <i class="mdi mdi-account"></i>
              </span>
                    <span class="menu-title">Profile</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="pa.php">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
                    <span class="menu-title">Change Password</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="logout.php">
              <span class="menu-icon">
                <i class="mdi mdi-power-settings"></i>
              </span>
                    <span class="menu-title">Log-Out</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav w-100">
                    <li class="nav-item w-100">
                        <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                            <input type="text" class="form-control" placeholder="Search products">
                        </form>
                    </li>
                </ul>
                
                <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">Posts</a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                        <h6 class="p-3 mb-0">All Post</h6>
                        <div class="dropdown-divider"></div>
                        <a href="manage-posts.php" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-file-outline text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1">All Posts</p>
                                </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="add-post.php"  class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-web text-info"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1">Add Post</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="manage-category.php" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-layers text-danger"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject ellipsis mb-1">Category</p>
                            </div>
                        </a>
                </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-view-grid"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown border-left">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-bell"></i>
                            <span class="count bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notifications</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-calendar text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Event today</p>
                                    <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item"href="pa.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-settings text-danger"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Settings</p>
                                    <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-link-variant text-warning"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Launch Admin</p>
                                    <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <p class="p-3 mb-0 text-center">See all notifications</p>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                            <div class="navbar-profile">
                                <img class="img-xs rounded-circle" src="assets/images/user.png" alt="">
                                <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $username; ?></p>
                                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                            <h6 class="p-3 mb-0">Profile</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item" href="profile.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-settings text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Settings</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item" href="logout.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-logout text-danger"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Log out</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <p class="p-3 mb-0 text-center">Advanced settings</p>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-format-line-spacing"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">




















                <!-- container-scroller -->
                <!-- plugins:js -->
                <script src="assets/vendors/js/vendor.bundle.base.js"></script>
                <!-- endinject -->
                <!-- Plugin js for this page -->
                <script src="assets/vendors/chart.js/Chart.min.js"></script>
                <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
                <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
                <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
                <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
                <!-- End plugin js for this page -->
                <!-- inject:js -->
                <script src="assets/js/off-canvas.js"></script>
                <script src="assets/js/hoverable-collapse.js"></script>
                <script src="assets/js/misc.js"></script>
                <script src="assets/js/settings.js"></script>
                <script src="assets/js/todolist.js"></script>
                <!-- endinject -->
                <!-- Custom js for this page -->
                <script src="assets/js/dashboard.js"></script>