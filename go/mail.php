<?php include "sidebar.php"; ?>
<div class="container-fluid">

    <!-- Title & Breadcrumbs-->
    <div class="card">
    <div class="card-body">
    <div class="row page-breadcrumbs">
        <div class="col-md-12 align-self-center">
            <h4 class="theme-cl">Inbox</h4>
        </div>
    </div>
    <!-- Title & Breadcrumbs-->

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
            <div class="card-body">

                <!-- mail Option -->
                <div class="inbox-mail-head padd-10 bb-1">
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox0" name="options[]" value="0">
									<label for="checkbox0"></label>
								</span>
                    All

                    <div class="btn-group mrg-l-10">
                        <button type="button" class="btn btn-secondary">
                            <i class=" mdi mdi-refresh"></i>
                        </button>
                    </div>


                    <div class="pull-right">
                        <span>Showing Entries</span>
                        <div class="btn-group mrg-l-5">
                            <button type="button" class="btn btn-secondary">
                                <i class="mdi mdi-angle-right pagination-left"></i>
                            </button>
                        </div>
                        <div class="btn-group mrg-l-5">
                            <button type="button" class="btn btn-secondary">
                                <i class="mdi mdi-angle-right pagination-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <ul class="media-body">
                    <!-- Single Mail -->
                    <?php
                    $query="SELECT * FROM mail where sender = '".$_SESSION['username']."'";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($result))
                    {
                        $status="$row[status]";
                        if($status==0)
                            $sta="Open";
                        if($status==1)
                            $sta="close";
                        if($status==1)
                            $color="success";
                        if($status==0)
                            $color="warning";

                        ?>
                        <li class="card-box">
                            <div class="ground">
                                <div class="pull-left">
                                    <div class="controls">
												<span class="custom-checkbox">
													<input type="checkbox" id="checkbox1" name="options[]" value="1">
													<label for="checkbox1"></label>
												</span>
                                        <a href="javascript:;" class="favouritec text-muted  hidden-sm-down" data-toggle="active">
                                            <i class="mdi mdi-star" aria-hidden="true"></i>
                                        </a>
                                    </div>
<!--                                    <div class="thumb hidden-sm-down m-r-20"> <img src="assets/dist/img/add-user.png" class="avatar avatar-lg" alt=""> </div>-->
                                </div>
                                <div class="media-body">
                                    <div class="media-success">
                                        <form action="viewticket.php" method="post">
                                            <input type="hidden" name="id" value="<?php print "$row[id]"; ?>">

                                            <span class="badge bg-<?php echo $color; ?>"><?php echo $sta; ?></span>
                                            <small class="float-right text-muted"><time class="hidden-sm-down" datetime="2021"><?php  print "$row[date]"; ?></time><i class="mdi mdi-attachment"></i> <br>
                                                <button class="badge btn-rounded btn-outline-info">View Ticket</button></small>

                                        </form>
                                    </div>
                                    <p class="msg"><?php  print "$row[subject]"; ?></p>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>

            </div>
        </div>
    </div>

</div>
