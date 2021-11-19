<?php include "sidebar.php"; ?>
<div class="card">
    <div class="card-body">
        <div class="box w3-card-4">
<?php
if($_GET['action']='del')
{
    $postid=intval($_GET['pid']);
    $query=mysqli_query($con,"update tblposts set Is_Active=0 where id='$postid'");
    if($query)
    {
        $msg="Post deleted ";
    }
    else{
        $error="Something went wrong . Please try again.";
    }
}
?>

            <link href="/go/plugins/summernote/summernote.css" rel="stylesheet" />

            <!-- Select2 -->
            <link href="/go/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

            <!-- Jquery filer css -->
            <link href="/go/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
            <link href="/go/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
            <!--        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
<!--            <link href="assets/css/core.css" rel="stylesheet" type="text/css" />-->
            <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
            <!--        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />-->
            <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="/go/plugins/switchery/switchery.min.css">
            <script src="assets/js/modernizr.min.js"></script>


<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>


<script src="assets/js/modernizr.min.js"></script>

+

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
<!--    --><?php //include('includes/topheader.php');?>

    <!-- ========== Left Sidebar Start ========== -->
<!--    --><?php //include('includes/leftsidebar.php');?>


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">


                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Manage Posts </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="#">Admin</a>
                                </li>
                                <li>
                                    <a href="#">Posts</a>
                                </li>
                                <li class="active">
                                    Manage Post
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->




                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">


                            <div class="table-responsive">
                                <table class="table table-colored table-centered table-inverse m-0">
                                    <thead>
                                    <tr>

                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $query=mysqli_query($con,"select tblposts.id as postid,tblposts.PostTitle as title,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 ");
                                    $rowcount=mysqli_num_rows($query);
                                    if($rowcount==0)
                                    {
                                        ?>
                                        <tr>

                                            <td colspan="4" align="center"><h3 style="color:red">No record found</h3></td>
                                        <tr>
                                        <?php
                                    } else {
                                        while($row=mysqli_fetch_array($query))
                                        {
                                            ?>
                                            <tr>
                                                <td><b><?php echo htmlentities($row['title']);?></b></td>
                                                <td><?php echo htmlentities($row['category'])?></td>
                                                <td><?php echo htmlentities($row['subcategory'])?></td>

                                                <td><a href="edit-post.php?pid=<?php echo htmlentities($row['postid']);?>"><i class="mdi mdi-pencil" style="color: #29b6f6;"></i></a>
                                                    &nbsp;<a href="manage-posts.php?pid=<?php echo htmlentities($row['postid']);?>&&action=del" onclick="return confirm('Do you reaaly want to delete ?')"> <i class="mdi mdi-trash-can" style="color: #f05050"></i></a> </td>
                                            </tr>
                                        <?php } }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


<!--                --><?php //} ?>
            </div> <!-- container -->

        </div> <!-- content -->

<!--        --><?php //include('includes/footer.php');?>

    </div>














</div>
        <!-- END wrapper -->



    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="/go/plugins/switchery/switchery.min.js"></script>

<!-- CounterUp  -->
<script src="/go/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="/go/plugins/counterup/jquery.counterup.min.js"></script>

<!--Morris Chart-->
<script src="/go/plugins/morris/morris.min.js"></script>
<script src="/go/plugins/raphael/raphael-min.js"></script>

<!-- Load page level scripts-->
<script src="/go/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="/go/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/go/plugins/jvectormap/gdp-data.js"></script>
<script src="/go/plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>


<!-- Dashboard Init js -->
<script src="assets/pages/jquery.blog-dashboard.js"></script>

<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>
