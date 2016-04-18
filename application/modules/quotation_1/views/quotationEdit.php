
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container row">
                    <div class="clearfix">
                        
                         <div class="col-md-12 text-success">
                            <?php echo $this->session->flashdata('message'); ?>
                         </div>
                        
                        <div class="col-md-12">
                            <h3 class="pull-left page-title">Modify Quotation Request Detail</h3>
                            <a href="quotation-detail.html" class="btn  btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>

                        </div>
                    </div>

                    <!-- Main Div Start -->
                    <section class="clearfix detailbox">


                        <div class="bg-white">
                            <!-- Table Section Start -->

                            <!-- Top Section Start -->
                            <article class="clearfix p-t-20 appt-detail">
                                  <?php  $isActive = 0; if(!empty($quotationDetail) && $quotationDetail[0]->bookStatus == 1){ $isActive = 1; } ?>
                                
                                 <form class="cmxform form-horizontal tasi-form avatar-form" id="submitForm" name="quotationEditForm" method="post" action="<?php echo site_url(); ?>/quotation/saveEditQuotationDetail/<?php echo $quotationDetail[0]->qId;  ?>" novalidate="novalidate" enctype="multipart/form-data">
                                     <div id="upload_modal_form">
                                        <?php $this->load->view('upload_crop_modal');?>
                                    </div>
                                <aside class="col-md-6 col-sm-6">
                                 
                                    <div class="clearfix m-t-10">
                                        <label class="col-md-4 col-sm-4">Quotation Id :</label>
                                        <p class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" name="quotationId" value="<?php if(!empty($quotationDetail) && $quotationDetail[0]->uniqueId != ''){ echo $quotationDetail[0]->uniqueId;  } ?>" readonly />
                                        </p>
                                    </div>


                                    <div class="clearfix m-t-10">
                                        <label class="col-md-4 col-sm-4">HMS Id :</label>
                                        <p class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" name="hmsId" value="NA" />
                                        </p>
                                    </div>

                                    <div class="clearfix m-t-10">
                                        <label class="col-md-4 col-sm-4">Appointment Type :</label>
                                        <p class="col-md-8 col-sm-8">
                                            <input type="text" class="form-control" name="apptType" value="Consutation" />
                                            <label class="error" > <?php echo form_error("apptType"); ?></label>
                                        </p>
                                    </div>


                                    <div class="clearfix m-t-10">
                                        <label class="col-md-4 col-sm-4">Pref. Appt. Date :</label>
                                        <p class="col-md-8 col-sm-8">
                                            <div class="input-group" style="padding:5px 15px;">
                                                <input class="form-control" placeholder="dd/mm/yyyy" value="<?php if(!empty($quotationDetail) && $quotationDetail[0]->dt != ''){ echo date('m/d/Y',$quotationDetail[0]->dt);  }else{ echo 'NA';} ?>" id="date-5" type="text" name="preferedDate" onkeydown="return false;">
                                                <label class="error" > <?php echo form_error("preferedDate"); ?></label>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </p>
                                    </div>

                                   <!-- <div class="clearfix m-t-10">
                                        <label class="col-md-4 col-sm-4">Pref. Session :</label>
                                        <p class="col-md-8 col-sm-8">
                                            <select class="selectpicker" data-width="100%" name="prefSession">
                                                <option value="1">Morning | 08:00 - 12:00</option>
                                                <option value="2">Afternoon | 12:00 - 04:00</option>
                                                <option value="3">Evening | 04:00 - 09:00</option>
                                            </select>
                                            <label class="error" > <?php // echo form_error("prefSession"); ?></label>
                                        </p>
                                    </div> -->

                                    <div class="clearfix m-t-10">
                                        <label class="col-md-4 col-sm-4">Prescription :</label>
                                        <div class="col-md-8 col-sm-8 text-right">
                                            <input id="uploadFile" class="showUpload" disabled="disabled" />
                                            <div class="fileUpload btn btn-sm btn-upload avatar-view">
                                                <span><i class="fa fa-cloud-upload fa-3x "></i></span>
                                                <!--<input id="uploadBtn" type="file" class="upload" />-->
                                               
                                                <label class="error" > <?php echo $this->session->flashdata('valid_upload'); ?></label>
                                                <img src="<?php echo base_url('assets/images/noImage.png'); ?>" width="70" height="65" class="image-preview-show"/>
                                            </div>
                                        </div>
                                    </div>
                                  
                                     <section id="effect-3" class="effects clearfix">
                                        <aside class="col-md-12">
                                            <?php if(isset($quotationPrescription) && !empty($quotationPrescription)){
                                                        foreach ($quotationPrescription as $key=>$val){ ?>
                                            
                                            <article class="img m-t-10">
                                                <img src="<?php if($val->pricription != '') { echo base_url($val->pricription); } ?>" alt="">
                                                <div class="overlay">
                                                    <a href=""><i class="fa fa-search"></i></a>&nbsp;
                                                    <a href="#"><i class="fa fa-download"></i></a>
                                                    <a class="close-overlay hidden">x</a>
                                                </div>
                                            </article>
                                          
                                            <?php } } ?>
                                        </aside>

                                    </section>
                                    
                                </aside>
                                 <aside class="col-md-6 col-sm-6">
                                    <div class="clearfix m-t-20">
                                        <article class="col-md-2 p-0 pull-right m-r-20">
                                            <img src="<?php if(!empty($quotationDetail) && $quotationDetail[0]->pImg != ''){ echo base_url($quotationDetail[0]->pImg);  }else{ echo base_url('assets/images/noImage.png');} ?>" alt="" class="img-responsive patient-pic">
                                        </article>
                                        <article class="col-md-5 text-right pull-right">
                                            <h3><?php if(!empty($quotationDetail) && $quotationDetail[0]->pName != ''){ echo $quotationDetail[0]->pName;  }else{ echo 'NA';} ?></h3>
                                            
                                            <p><?php if(!empty($quotationDetail) && $quotationDetail[0]->gender != ''){ echo getGender($quotationDetail[0]->gender);  }else{ echo 'NA';} ?>  <?php if(!empty($quotationDetail) && $quotationDetail[0]->userAge != ''){ echo isBlank($quotationDetail[0]->userAge);  }else{ echo 'NA';} ?> Year</p>
                                            
                                            <p><?php if(!empty($quotationDetail) && $quotationDetail[0]->contact != ''){ echo $quotationDetail[0]->contact;  }else{ echo 'NA';} ?></p>
                                        </article>
                                    </div>

                                    <div class="clearfix m-t-20">
                                        <article class="col-md-2 p-0 pull-right m-r-20">
                                            <img src="<?php if(!empty($quotationDetail) && $quotationDetail[0]->miImg != ''){ echo base_url($quotationDetail[0]->miImg);  }else{ echo base_url('assets/images/noImage.png');} ?>" alt="" class="img-responsive patient-pic">
                                        </article>
                                        <article class="col-md-5 text-right pull-right">
                                            <h3><?php if(!empty($quotationDetail) && $quotationDetail[0]->miName != ''){ echo $quotationDetail[0]->miName;  }else{ echo 'NA';} ?></h3>
                                            <p><?php if(!empty($quotationDetail) && $quotationDetail[0]->miNumber != ''){ echo $quotationDetail[0]->miNumber;  }else{ echo 'NA';} ?></p>
                                        </article>
                                    </div>
                                    <div class="clearfix m-t-20 text-right">
                                        
                                        <?php if($isActive == 1){ ?>
                                        <button type="button" class="btn btn-danger waves-effect m-r-10"  onclick="rejectQuotation(<?php echo $quotationDetail[0]->bookId; ?>)" >Reject</button>
                                        <?php }else{ ?>
                                         <button type="button" class="btn btn-danger waves-effect m-r-10" >Rejected</button>
                                        <?php } ?>
                                         
                                         <?php if($isActive == 1){ ?>
                                        <button  class="btn btn-success waves-effect waves-light m-r-10" type="submit">Modify Quotation </button>
                                         <?php }else{ ?>
                                        <a  class="btn btn-success waves-effect waves-light m-r-10" href="javascript:void(0)">Modify Quotation </a>
                                         <?php } ?>
                                        
                                         <?php if($isActive == 1){ ?>
                                        <a class="btn btn-appointment waves-effect waves-light m-t-sm-10" href="<?php echo site_url('quotation/sendQuotationToUser').'/'.$quotationDetail[0]->qId; ?>">Send Quotation</a>
                                        <?php }else{ ?>
                                        <a class="btn btn-appointment waves-effect waves-light m-t-sm-10" href="javascript:void(0)">Send Quotation</a>
                                        <?php } ?>
                                    </div>
                                </aside>
                                      
                               </form>
                            </article>


                            <!-- Top Secton Ends-->
                            <hr class="hr-appt-detail" />

                            <!-- Bottom Section Start -->
                             <article class="clearfix m-r-20 m-r-0 p-b-20">
                                <aside class="col-md-12 col-xs-12">
                                    <section class="table-responsive">
                                        <table class="table table-borderd quotation-table">
                                            <tr>
                                                <th>Category</th>
                                                <th>Test Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Instruction</th>
                                                <th>Pricing</th>
                                                <th>Action</th>
                                            </tr>
                                            
                                    <?php $total = ''; 
                                    if(isset($quotationTest) && !empty($quotationTest)){
                                         foreach ($quotationTest as $key=>$val){ $total = $total + $val->price; ?>
                                                            
                                          <tr>
                                                <td>
                                                   
                                                      <article class="qEdit<?php echo $val->testId; ?>">
                                                        <select class="selectpicker" data-width="100%" name="diagnosticType" id="diagnosticType<?php echo $val->testId; ?>" >
                                                           <?php if(isset($dignoCat) && !empty($dignoCat)){
                                                                    foreach ($dignoCat as $key1=>$val1){
                                                                             ?>
                                                            
                                                                            <option <?php if($val->diagnoCatId != '' && $val->diagnoCatId == $val1->catId){ echo 'selected'; } ?> value="<?php echo $val1->catId; ?>" ><?php echo $val1->catName; ?></option>
                                                                       
                                                                    <?php }  } ?>
                                                        </select>
                                                      </article>
                                                </td>
                                                
                                                <td>
                                                   
                                                    <article class="qEdit<?php echo $val->testId; ?>" >
                                                         <input type="text" class="form-control qEdit<?php echo $val->testId; ?>" name="testName" id="testName<?php echo $val->testId; ?>" value="<?php echo $val->testName; ?>"/>
                                                         <label class="error" style="display:none;" id="error-testName<?php echo $val->testId; ?>">Test should be alphanumeric</label>
                                                    </article>
                                                </td>
                                                
                                                <td>
                                                   
                                                    <div class="input-group qEdit<?php echo $val->testId; ?>">
                                                        
                                                        <input class="form-control pickDate date-3  date<?php echo $val->testId; ?>" placeholder="dd/mm/yyyy" value="<?php echo date("m/d/Y",$val->date); ?>"  type="text" name="date" onkeydown="return false;">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </td>
                                                <td>
                                                  
                                                    <div class="bootstrap-timepicker input-group qEdit<?php echo $val->testId; ?>">
                                                        <input id="timepicker4" type="text" class="form-control timepicker time<?php echo $val->testId; ?>" value="<?php echo date("h:i a",$val->date); ?>" />
                                                    </div>
                                                </td>

                                                <td>
                                                     
                                                    <textarea id="instruction<?php echo $val->testId; ?>" class="form-control qEdit<?php echo $val->testId; ?>"><?php echo $val->instruction; ?></textarea>
                                                </td>
                                                
                                                <td>
                                                     
                                                    <input type="text" id="price<?php echo $val->testId; ?>" class="form-control qEdit<?php echo $val->testId; ?>" value="<?php echo $val->price; ?>"/>
                                                    <label class="error" style="display:none;" id="error-price<?php echo $val->testId; ?>">Price should be a number</label>
                                                </td>
                                                
                                                <td>
                                                    <p><a <?php if( $isActive == 1 ){?> onclick="deleteFn(<?php echo $val->testId; ?>)" <?php } ?> class="btn btn-danger btn-sm waves-effect waves-light m-tb-sm-3" href="javascript:void(0)">Delete</a></p>
                                                    
                                                    <input type="hidden" value="0" name="isEdit<?php echo $val->testId; ?>" id="isEdit<?php echo $val->testId; ?>">
                                                    <input type="hidden" value="<?php echo $val->testId; ?>" name="isShow<?php echo $val->testId; ?>" id="isShow<?php echo $val->testId; ?>">
                                                    
                                                    <a class="btn btn-success btn-sm waves-effect waves-light m-tb-sm-3 qUpdateBtn<?php echo $val->testId; ?>" <?php if( $isActive == 1 ){?> onclick="updateFn(<?php echo $val->testId; ?>);" <?php } ?> href="javascript:void(0)">Update</a>
                                                </td>
                                            </tr>
                                              <?php } } ?>
                                                       
                                                       <tr>
                                                           
                                                       </tr>
                                                
                                            
                                        </table>
                                    </section>
                                    <h5 class="h5-title text-right">Total Quotation Amount : <?php echo $total; ?></h5>
                                </aside>
                            </article>

                            <!-- Bottom Secton Ends-->
                        </div>
                    </section>

                    <!-- container -->
                </div>
                <!-- content -->
              



