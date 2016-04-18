<div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        <div class="col-md-12 text-danger">
                            <?php //echo $this->session->flashdata('message'); ?>
                 </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Sponsor Health Tips</h3>

                        </div>
                    </div>

                    <!-- Main Div Start -->
                    <section class="clearfix detailbox">
                        <!-- Form Section Start -->
                        <article class="row p-b-10">
                            <form>
                                <aside class="col-md-2 col-sm-2 m-t-xs-2">
                            <select class="selectpicker" data-width="110%" name="src_cat" id="src_cat" data-size="5" onchange ="loadData(1)">

                                <option value="">Search Category</option>
                                <?php foreach ($allCategories as $key => $val) { ?>
                                    <option value="<?php echo $val->category_id; ?>"><?php echo $val->category_name; ?></option>
                                <?php } ?>
                            </select>

                        </aside>
                            </form>
                        </article>
                        <!-- Form Section End -->

                        <div class="bg-white" id="sponserdiv">
                        </div>
                        
                        
                        
                        
                        <!--Modal Start-->
                         <div id="sponserModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Healthtip Sponsorship</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div id="messageErrors"></div>
                                        <form class="form-horizontal" id="uploadimage" action="" method="post" enctype="multipart/form-data">

                                         <input type='hidden' id='healthtipid' name='healthtipid' >
                                            <article class="form-group m-lr-0 ">
      
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Select City:</label>
                                                <div class="input-group col-md-8">
                                                <select name='' id=''>
                                                </select>
                                                </div>
                                            </article>

                                            <article class="form-group m-lr-0 ">
      
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Sponsor HealthTip:</label>
                                            </article>
                         <article class="form-group m-lr-0 ">
                                                <div class="col-md-8 col-sm-8 text-right">
                                                    <div id="sponser-dates" class="box"  class="hasDatepicker"></div>
                                                    <input id="altField" type="text">
                                                </div>
                                            </article>
<!--<h4 id='loading' >loading..</h4>-->
                                            <article class="clearfix m-t-20">
                                                <button type="submit" name="submit" class="btn btn-primary pull-right waves-effect waves-light bg-btn m-r-20">Upload</button>
                                            </article>
                                        </form>
                                    </div>

                                </div>
                                
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                        <!--Modal End-->
                    </section>

                    <!-- container -->
                </div>
                
