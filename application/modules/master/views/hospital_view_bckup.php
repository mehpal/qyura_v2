<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Hospitals</h3>
                    <a href="<?php echo site_url() ?>/master/mi_master/addHospital/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-10 detailbox m-b-20">
                <aside class="bg-white">
                <figure class="clearfix">
                <h3>Available Hospitals</h3>
               <article class="clearfix">
                  <div class="input-group m-b-5">
                     <span class="input-group-btn">
                     <button class="b-search waves-effect waves-light btn-success" type="button"><i class="fa fa-search"></i></button>
                     </span>
                     <input type="text" placeholder="Search" class="form-control" id="search-text">
                  </div>
               </article>
            </figure>
                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                        <div class="col-sm-12 p-t-20 p-b-20">
                            <?php if(isset($hospital_list) && $hospital_list != NULL){ 
                                foreach ($hospital_list as $hospital){ ?>
                                <article class="clearfix degrees membership-plan">
                                    <aside class="col-lg-9 col-sm-9 col-xs-9">
                                        <?php echo $hospital->hospital_name; ?>
                                    </aside>
                                    <aside class="col-lg-3 col-sm-3 col-xs-3">
                                        <a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo site_url('master/mi_master/editHospitalView/' . $hospital->hospital_id); ?>"><i class="fa fa-pencil"></i></a>
                                        <button onclick="enableFn('master/mi_master', 'hospitalPublish', '<?php echo $hospital->hospital_id; ?>','<?php echo $hospital->status; ?>')" title='<?php if($hospital->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> Hospital' type="button" class="btn btn-success waves-effect waves-light m-b-5"><i class="fa fa-thumbs-<?php if($hospital->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
                                        
                                    </aside>
                                </article>
                            <?php } } ?>
                        </div>
                    </div>
                </aside>
            </section>
            <!-- Left Section End -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->