


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
                     <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="submitForm" method="post" action="<?php echo site_url(); ?>/qap/saveEditqap" novalidate="novalidate" enctype="multipart/form-data" >
                        <input type="hidden" name="qap_id" value="<?php if(isset($qapData) && !empty($qapData)){echo $qapData[0]->qap_id; }?>" />
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
                                                    <input class="form-control" id="qap_name" name="qap_name" type="text" required="" value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_name;} ?>">
                                                   <label class="error" > <?php echo form_error("qap_name"); ?></label>
                                                </div>
                                            </article>
                                            
                                    <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4 col-sm-4">Email Id :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input type="email" class="form-control" id="qap_email" name="qap_email" placeholder=""  value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_email;} ?>"/>
                                           
                                           <!--onblur="checkEmailFormat()"-->
                                          
                                            <label class="error" > <?php echo form_error("qap_email"); ?></label>
                                        </div>
                                    </article>
                                          
                                            <article class="clearfix m-t-10 avatar-view">
                                                <label class="control-label col-md-4 col-sm-4" for="cemail">Upload Logo :</label>
                                                <div class="col-md-8 col-sm-8 text-right">
                                                        <label for="file-input"><i style="border:1px solid #777777; padding:10px;" class="fa fa-cloud-upload fa-3x avatar-view"></i></label>
                                                     <input type="file" style="display:none;" class="no-display " id="file-input11" name="qap_image">
<!--                                                   <input type="file" style="display:none;" class="no-display" id="file-input" name="ambulance_img">-->     
                                                
                                              <img src="<?php echo base_url().'assets/default-images/ambulance_logo.png'?>" width="70" height="65" class="image-preview-show"/>
                                            <label class="error" > <?php echo form_error("avatar_file"); ?></label>
                                            <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                                </div>
                                            </article>
                                  
                                            <article class="clearfix m-t-10">
                                                  <label for="cname" class="control-label col-md-4 col-sm-4">City :</label>
                                                <div class="col-sm-8 col-sm-8">
                                          
                                                      <select class="form-control selectpicker" data-width="100%" name="qap_city" id="qap_city" required="">
                                                  <option value="">Select Bank City</option>
                                                    <?php foreach ($allCity as $key => $val) { ?>
                                                        <option value="<?php echo $val->city_name; ?>" <?php if($val->city_name == $qapData[0]->qap_city): echo"selected";endif;?>><?php echo $val->city_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                   
                                                    <label class="error" > <?php echo form_error("qap_city"); ?></label>
                                        </div>
                                            </article>
                                           
                                
                                             <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Mobile No. :</label>
                                        <div class="col-md-8 col-sm-8">
                            
                                                    <input type="text" class="form-control" name="qap_phone" id="qap_phone" placeholder="" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_phone;} ?>"/>
                                                   
                                                    <label class="error" > <?php echo form_error("qap_phone"); ?></label>
                                            
                                        </div>
                                    </article>
                                            
                                                     
                                            <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4">Address :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" name="qap_address" type="text" required="" id="qap_address" value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_address;} ?>"> 
                                          
                                           <label class="error" > <?php echo form_error("qap_address"); ?></label>
                                        </div>
                                    </article>
                                            
                                          
                                   <article class="form-group m-lr-0 ">
                                        <label for="cemail" class="control-label col-md-4 col-sm-4"> QAP Code :</label>
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" name="qap_code" type="text" required="" id="qap_code" value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_code;} ?>" disabled>
                                          
                                           <label class="error" > <?php echo form_error("qap_code"); ?></label>
                                        </div>
                                    </article>
                                            
                                             <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4"> Bank Name :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="qap_bank_name" name="qap_bank_name" type="text" required="" value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_bank_name;} ?>">
                                                    
                                                    <label class="error" > <?php echo form_error("qap_bank_name"); ?></label>
                                                </div>
                                            </article>
                                            
                                                   <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">Account No. :</label>
                                        <div class="col-md-8 col-sm-8">
                                         
                                              
                                                    <input type="text" class="form-control" name="qap_accountNo" id="qap_accountNo" placeholder="" maxlength="10"value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_accountNo;} ?>"/>
                                                    
                                                    <label class="error" > <?php echo form_error("qap_accountNo"); ?></label>
                                            
                                        </div>
                                    </article>
                                              <article class="clearfix m-t-10">
                                                <label for="cemail" class="control-label col-md-4 col-sm-4"> Branch :</label>
                                                <div class="col-md-8 col-sm-8">
                                                    <input class="form-control" id="qap_branch" name="qap_branch" type="text" required="" value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_branch;} ?>">
                                                  
                                                    <label class="error" > <?php echo form_error("qap_branch"); ?></label>
                                                </div>
                                            </article>
                                            
                           
                                            
                                                       <article class="clearfix m-t-10">
                                        <label for="cname" class="control-label col-md-4  col-sm-4">IFSC Code :</label>
                                        <div class="col-md-8 col-sm-8">
                                                    <input type="text" class="form-control" name="qap_ifscCode" id="qap_ifscCode" placeholder="" maxlength="10"value="<?php if(isset($qapData) && !empty($qapData)){ echo $qapData[0]->qap_ifscCode;} ?>"/>
                                                   
                                                    <label class="error" > <?php echo form_error("qap_ifscCode"); ?></label>
                                            
                                        </div>
                                    </article>
                           
                                   
                                            <article class="clearfix m-t-10">
                                                  <label for="cname" class="control-label col-md-4 col-sm-4">Bank City :</label>
                                                <div class="col-sm-8 col-sm-8">
                                          
                                                      <select class="form-control selectpicker" data-width="100%" name="qap_bankCity" id="qap_bankCity" required="">
                                                  <option value="">Select Bank City</option>
                                                    <?php foreach ($allCity as $key => $val) { ?>
                                                        <option value="<?php echo $val->city_name; ?>" <?php if($val->city_name == $qapData[0]->qap_bankCity): echo"selected";endif;?>><?php echo $val->city_name; ?></option>
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
