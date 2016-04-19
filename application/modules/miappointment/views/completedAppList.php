
<!-- Begin page -->
<div id="wrapper">
    <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="clearfix">
                    <div class="col-md-12">
                        <h3 class="pull-left page-title">Upload Reports</h43>
                    </div>
                </div>

                <!-- Left Section Start -->
                <section class="col-md-12 detailbox">


                    <!-- Form Section Start -->
                    <article class="row p-b-10">
                        <form>
                            <aside class="col-md-2 col-sm-3">
                                <a href="#" title="Upload New Report" class="btn btn-appointment waves-effect waves-light">Upload New</a>
                            </aside>
                            <aside class="col-md-3 col-sm-5 m-tb-xs-5">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <input id="search" type="text" name="search" class="form-control" placeholder="Search" />
                                </div>
                            </aside>
                            <aside class="col-md-2 col-sm-2 pull-right">
                                <button class="btn btn-appointment waves-effect waves-light m-l-10 pull-right" type="submit">Export</button>
                            </aside>

                        </form>
                    </article>
                    <!-- Form Section End -->

                    <div class="bg-white" id="reportList">
                        <!-- Table Section Start -->
                        <article class="clearfix m-top-40 p-b-20">
                            <aside class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="border-a-dull">
                                            <th>Appt Id</th>
                                            <th>MI Name</th>
                                            <th>Patient Name</th>
                                            <th>Phone</th>
                                            <th>Email Id</th>
                                            <th>Action</th>
                                        </tr>
                                    <thead>
                                    <tbody >
                                        <?php if (isset($reports) && !empty($reports)) {
                                            foreach ($reports as $key => $val) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <h6><?php echo isset($val['orderId']) ? $val['orderId'] : '' ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo isset($val['miName']) ? $val['miName'] : '' ?></h6>
                                                        <p><?php echo isset($val['city_name']) ? $val['city_name'] : '' ?></p>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo isset($val['userName']) ? $val['userName'] : '' ?></h6>
                                                        <p><?php echo isset($val['userGender']) ? $val['userGender'] : '' ?> | <?php echo isset($val['userAge']) ? $val['userAge'] : '' ?></p>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo isset($val['usersMobile']) ? $val['usersMobile'] : '' ?></h6>
                                                    </td>
                                                    <td>
                                                        <h6><?php echo isset($val['email']) ? $val['email'] : '' ?></h6>
                                                    </td>
                                                    <td>
                                                    <form id="form_<?php echo $val['orderId']; ?>" prdoc="pr_<?php echo $val['orderId']; ?>" class="uploadimage" action="" method="post" enctype="multipart/form-data">
                                                        <a href="<?php echo detailRouter($val['type'], $val['id'], $val['orderId']) ?>" class="btn btn-warning waves-effect waves-light m-b-5" type="button">View</a>
<!--                                                        <input type="file" id="file-<?php echo $val['orderId']; ?>" class="uploadfile" name="image[]" multiple=""  required class="uploadfile" />-->
                                                        <i class="btn btn-warning waves-effect btn-up waves-light m-b-5 waves-input-wrapper" style=""><input type="file" id="file-<?php echo $val['orderId']; ?>" class="uploadfile" name="image[]" multiple="" required=""></i>
                                                        <input type="submit" id="sub_<?php echo $val['orderId']; ?>" class="btn btn-warning waves-effect waves-light m-b-5" value="submit" class="submit" />
                                                        <input type="hidden" value="<?php echo $val['orderId']; ?>" name="orderId" required />
<input type="hidden" value="<?php echo $val['type']; ?>" name="type" required />
                                                    </form>
                                                        
                                                        <div id="pr_<?php echo $val['orderId']; ?>" class="progress progress-striped active">
                                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 00%">
                                                            </div>
                                                        </div>

                                                        
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </aside>

                        </article>
                        <!-- Table Section End -->
                        <?php ?>
                        <article class="clearfix m-t-20 p-b-20">
                            <ul class="list-inline list-unstyled pull-right call-pagination">
                                <?php echo $this->ajax_pagination->create_links(); ?>
                            </ul>



                        </article>
                    </div>

                </section>
                <!-- Left Section End -->

            </div>

            <!-- container -->
        </div>
        <!-- content -->
        <footer class="footer text-right">
            2015 © Qyura.
        </footer>
    </div>
    <!-- End Right content here -->
</div>
<!-- END wrapper -->