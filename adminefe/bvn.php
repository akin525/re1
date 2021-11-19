<?php include "sidebar.php"; ?>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="mb-3 align-items-center me-auto">
                    <h4 class="card-title">USERS Bvn</h4>
                    <span class="fs-12">All Users Bvn</span>
                </div>
                <a href="javascript:void(0);" class="btn btn-outline-primary mb-3"><i class="fa fa-calendar me-3 scale3"></i>Filter Date</a>
            </div>


            <div class="row">
                <div class="col-xl-12">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                        <label class="form-check-label" for="checkAll">
                                        </label>
                                    </div>
                                </th>
                                <th>ID </th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Bvn</th>
                            </tr>
                            </tr>
                            </thead>
                            <?php
                            $query="SELECT * FROM userbvn";
                            $result = mysqli_query($con,$query);
                            while($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                            <label class="form-check-label" for="flexCheckDefault2">
                                            </label>
                                        </div>
                                    </td>
                                    <td><?php echo $row["id"] ; ?></span></td>
                                    <td><?php echo decryptdata($row["username"]) ; ?></td>
                                    <td><?php echo decryptdata($row["name"]) ; ?></td>
                                    <td><?php echo $row["bvn"] ; ?></td>
                                    <td>
                                        <div>
                                            <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                <!--                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                                <!--                        <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>-->
                                                <!--                        <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>-->
                                                <!--                        <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>-->
                                                <!--                    </svg>-->
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>



                            </thead>
                        </table>
                        </thead>
                        </table>


