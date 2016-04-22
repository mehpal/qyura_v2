


<div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="clearfix">
                        <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Add New QAP</h3>

                        </div>
                    </div>
                    <div class="map_canvas"></div>
                     <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/qap/SaveQap" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" id="StateId" name="StateId" value="" />
    <div style="display:none;position:absolute;top:50%;left:45%;padding:2px;z-index: 10000" class="loader" id="defaultloader">
    <img alt="Please wait data is loading" src="<?php echo base_url('assets/images/beet.gif');?>" /> 
</div>
                       
                        <!-- Left Section Start -->
                        <section class="col-md-12 detailbox">
                            <div class="bg-white mi-form-section">
                                <article class="clearfix">
                                    <aside class="col-md-8">
                                        <div class="clearfix m-t-20 p-b-20">
                                            <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4"> Name :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="qap_name" name="qap_name" type="text" required="" value="<?php echo set_value('qap_name'); ?>">
                                                   <label class="error" > <?php echo form_error("qap_name"); ?></label>
                                                </div>
                                            </article>
                                            
                                    <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" class="form-control" id="qap_email" name="qap_email" placeholder="" value="<?php echo set_value('qap_email'); ?>"/>
                                         
                                           

                                   
                                          
                                            <label class="error" > <?php echo form_error("qap_email"); ?></label>
                                        </div>
                                    </article>
                                          
                                                 <article class="clearfix m-t-10">
                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                
                                <div class="col-md-8 col-sm-8" data-target="#modal" data-toggle="modal">
                                    <label class="col-md-4 col-sm-4" for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>

                                    <div class="pre col-md-4 col-sm-4 ">
                                    <div id="preImgLogo" class="avatar-preview preview-md">
                                        
                                   <img src="<?php echo base_url() ?>assets/default-images/Blood-logo.png"  class="image-preview-show"/>
                                        
                                    </div>
                                    </div>

                                    <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                    <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                    
                                    
                                    
                                </div>
                                
                            </article>
                                  
                                            <article class="clearfix m-t-10">
                                                  <label for="cname" class="control-label col-md-4 col-sm-4">City :</label>
                                                <div class="col-sm-8 col-sm-8">
                                          
                                                      <select class="form-control selectpicker" data-width="100%" name="qap_city" id="qap_city" required="">
                                                  <option value="">Select City</option>
                                                    <?php foreach ($allCity as $key => $val) { ?>
                                                        <option value="<?php echo $val->city_name; ?>" <?php echo set_select('qap_city', $val->city_name); ?>><?php echo $val->city_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                   
                                                    <label class="error" > <?php echo form_error("qap_city"); ?></label>
                                        </div>
                                            </article>
                                           
                                
                                             <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Mobile No. :</label>
                                        <div class="col-md-8 col-sm-8">
                            
                                                    <input type="text" class="form-control" name="qap_phone" id="qap_phone" placeholder="" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?php echo set_value('qap_phone'); ?>"/>
                                                   
                                                    <label class="error" > <?php echo form_error("qap_phone"); ?></label>
                                            
                                        </div>
                                    </article>
                                            
                                                     
                                            <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" name="qap_address" type="text" required="" id="qap_address" value="<?php echo set_value('qap_address'); ?>"> 
                                          
                                           <label class="error" > <?php echo form_error("qap_address"); ?></label>
                                        </div>
                                    </article>
                                            
                                          
                                  <article class="form-group m-lr-0 ">
                                      <?php   $data ="QAP".rand(0,9999);  ?>
                                                 
                                        <label for="cemail" class="control-label col-md-4 col-sm-4"> QAP Code :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" name="qap_code" type="text" required="" id="qap_code" value="<?php echo $data; ?>" readonly="readonly">
                                          
                                           <label class="error" > <?php echo form_error("qap_code"); ?></label>
                                        </div>
                                    </article>
                                             <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4"> Bank Name :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="qap_bank_name" name="qap_bank_name" type="text" required="" value="<?php echo set_value('qap_bank_name'); ?>">
                                                    
                                                    <label class="error" > <?php echo form_error("qap_bank_name"); ?></label>
                                                </div>
                                            </article>
                                            
                                                   <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Account No. :</label>
                                        <div class="col-md-8 col-sm-8">
                                         
                                              
                                                    <input type="text" class="form-control" name="qap_accountNo" id="qap_accountNo" placeholder="" maxlength="15" value="<?php echo set_value('users_mobile'); ?>"/>
                                                    
                                                    <label class="error" > <?php echo form_error("qap_accountNo"); ?></label>
                                            
                                        </div>
                                    </article>
                                              <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4"> Branch :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="qap_branch" name="qap_branch" type="text" required="" value="<?php echo set_value('qap_branch'); ?>">
                                                  
                                                    <label class="error" > <?php echo form_error("qap_branch"); ?></label>
                                                </div>
                                            </article>
                                                       <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">IFSC Code :</label>
                                        <div class="col-md-8 col-sm-8">
                                                    <input type="text" class="form-control" name="qap_ifscCode" id="qap_ifscCode" placeholder="" maxlength="11" value="<?php echo set_value('qap_ifscCode'); ?>"/>
                                                   
                                                    <label class="error" > <?php echo form_error("qap_ifscCode"); ?></label>
                                            
                                        </div>
                                    </article>
                                                <article class="clearfix m-t-10">
                                                  <label for="cname" class="control-label col-md-4 col-sm-4">Bank City :</label>
                                                <div class="col-sm-8 col-sm-8">
                                                    
                                                     <select class="form-control selectpicker" data-width="100%" name="qap_bankCity" id="qap_bankCity" required="">
                                                  <option value="">Select Bank City</option>
                                                    <?php foreach ($allCity as $key => $val) { ?>
                                                        <option value="<?php echo $val->city_name; ?>" <?php echo set_select('qap_bankCity', $val->city_name); ?>><?php echo $val->city_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                   
                                                    <label class="error" > <?php echo form_error("qap_bankCity"); ?></label>
                                        </div>
                                            </article>
                                           
                               
                                           
                                     

                                    </aside>
                                </article>
                                </div>
                                <!-- .form -->
                        

                        </section>
                        <!-- Left Section End -->


                            <section>
                            <div class="col-md-12 m-t-20 m-b-20">
                               
                                <div>
                                    <input class="btn btn-success waves-effect waves-light pull-right m-r-20" type="submit"  value="Submit" />
                                </div>
                            </div>

                        </section>

                        <fieldset>


                          </fieldset>
                        <div id="upload_modal_form">
                            <?php $this->load->view('upload_crop_modal');?>
                        </div>
                    </form>


                    <!-- consultation -->

                </div>

                <!-- container -->
            </div>
            
            <!-- content -->
