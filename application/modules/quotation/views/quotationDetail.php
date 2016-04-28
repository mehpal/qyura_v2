<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container row">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Quotation Request Detail</h3>
                    <a href="quotelist.html" class="btn btn-appointment btn-back waves-effect waves-light pull-right"><i class="fa fa-angle-left"></i> Back</a>
                </div>
            </div>

            <!-- Main Div Start -->
            <section class="col-md-12 detailbox">
                <div class="bg-white">
                    <!-- Table Section Start -->
                    <?php
                    $isActive = 0;
                   
                    if (!empty($quotationDetail) && $quotationDetail[0]->bookStatus == 1) {
                        $isActive = 1;
                    }
                    ?>
                    <!-- Top Section Start -->
                    <article class="clearfix p-t-20 appt-detail">
                        <aside class="col-md-6 col-sm-6">
                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Quotation Id :</label>
                                <p class="col-md-8"><?php
                                    if (!empty($quotationDetail) && $quotationDetail[0]->uniqueId != '') {
                                        echo $quotationDetail[0]->uniqueId;
                                    }
                                    ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Referred by :</label>
                                <p class="col-md-8"><?php
                                    if (!empty($quotationDetail) && $quotationDetail[0]->docName != '') {
                                        echo $quotationDetail[0]->docName;
                                    } else {
                                        echo 'NA';
                                    }
                                    ?></p>
                            </div>


                            <div class="clearfix m-t-10">
                                <label class="col-md-4">HMS Id :</label>
                                <p class="col-md-8">NA</p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Appointment Type :</label>
                                <p class="col-md-8">Consutation</p>
                            </div>


                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Pref. Appt. Date :</label>
                                <p class="col-md-8"><?php
                                    if (!empty($quotationDetail) && $quotationDetail[0]->dt != '') {
                                        echo date('F d, Y', $quotationDetail[0]->dt);
                                    } else {
                                        echo 'NA';
                                    }
                                    ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Pref. Session :</label>
                                <p class="col-md-8"><?php
                                    if (!empty($quotationDetail) && $quotationDetail[0]->timeslot != '') {
                                        echo $quotationDetail[0]->timeslot;
                                    } else {
                                        echo 'NA';
                                    }
                                    ?></p>
                            </div>

                            <div class="clearfix m-t-10">
                                <label class="col-md-4">Prescription :</label>
                            </div>

                            <section id="effect-3" class="effects clearfix">
                                <aside class="col-md-12">
                                    <?php
                                    if (isset($quotationPrescription) && !empty($quotationPrescription)) {
                                        foreach ($quotationPrescription as $key => $val) {
                                            ?>

                                            <article class="img m-t-10">
                                                <img src="<?php
                                                $prsImg = '';
                                                $Img = '';
                                                if ($val->pricription != '') {
                                                    echo base_url($val->pricription);
                                                    $prsImg = urlencode($val->pricription);
                                                    $Img = $val->pricription;
                                                }
                                                ?>" alt="">
                                                <div class="overlay">
                                                    <a target="_blank" href="<?php echo base_url($Img) ?>"><i class="fa fa-search"></i></a>&nbsp;
                                                    <a  href="<?php echo site_url("quotation/fileDownload?path={$prsImg}") ?>"><i class="fa fa-download"></i></a>
                                                    <a class="close-overlay hidden">x</a>
                                                </div>
                                            </article>

                                        <?php
                                        }
                                    }
                                    ?>
                                </aside>

                            </section>
                        </aside>
                        <aside class="col-md-6 col-sm-6">
                            <div class="clearfix m-t-20">
                                <article class="col-md-2 p-0 pull-right m-r-20">
                                    <img src="<?php
                                    if (!empty($quotationDetail) && $quotationDetail[0]->pImg != '') {
                                        echo base_url($quotationDetail[0]->pImg);
                                    } else {
                                        echo base_url('assets/images/noImage.png');
                                    }
                                    ?>" alt="" class="img-responsive patient-pic">
                                </article>
                                <article class="col-md-5 text-right pull-right">
                                    <h3><?php
                                        if (!empty($quotationDetail) && $quotationDetail[0]->pName != '') {
                                            echo $quotationDetail[0]->pName;
                                        } else {
                                            echo 'NA';
                                        }
                                        ?></h3>

                                    <p><?php
                                        if (!empty($quotationDetail) && $quotationDetail[0]->gender != '') {
                                            echo getGender($quotationDetail[0]->gender);
                                        } else {
                                            echo 'NA';
                                        }
                                        ?>  <?php
                                        if (!empty($quotationDetail) && $quotationDetail[0]->userAge != '') {
                                            echo isBlank($quotationDetail[0]->userAge);
                                        } else {
                                            echo 'NA';
                                        }
                                        ?> </p>

                                    <p><?php
                                        if (!empty($quotationDetail) && $quotationDetail[0]->contact != '') {
                                            echo $quotationDetail[0]->contact;
                                        } else {
                                            echo 'NA';
                                        }
                                        ?></p>
                                </article>
                            </div>

                            <div class="clearfix m-t-20">
                                <article class="col-md-2 p-0 pull-right m-r-20">
                                    <img src="<?php
                                    if (!empty($quotationDetail) && $quotationDetail[0]->miImg != '') {
                                        echo base_url($quotationDetail[0]->miImg);
                                    } else {
                                        echo base_url('assets/images/noImage.png');
                                    }
                                    ?>" alt="" class="img-responsive patient-pic">
                                </article>

                                <article class="col-md-5 text-right pull-right">
                                    <h3><?php
                                        if (!empty($quotationDetail) && $quotationDetail[0]->miName != '') {
                                            echo $quotationDetail[0]->miName;
                                        } else {
                                            echo 'NA';
                                        }
                                        ?></h3>
                                    <p><?php
                                        if (!empty($quotationDetail) && $quotationDetail[0]->miNumber != '') {
                                            echo $quotationDetail[0]->miNumber;
                                        } else {
                                            echo 'NA';
                                        }
                                        ?></p>
                                </article>

                            </div>
                            <div class="clearfix m-t-20 text-right">

                                <?php //if($isActive == 1){    ?>
<!--                                        <button type="button" class="btn btn-danger waves-effect m-r-10"  onclick="rejectQuotation(//<?php //echo $quotationDetail[0]->bookId;   ?>)" >Reject</button>-->
                                <?php //}else{    ?>
                                <!--                                         <button type="button" class="btn btn-danger waves-effect m-r-10" >Rejected</button>-->
<?php // }    ?>


                                <?php if ($isActive == 1) { ?> <a class="btn btn-success waves-effect waves-light m-r-10" href="<?php echo site_url('quotation/editQuotation') . '/' . $quotationDetail[0]->qId; ?>">Modify Quotation</a>
                                <?php } else { ?>
                                    <a class="btn btn-success waves-effect waves-light m-r-10" href="javascript:void(0)">Modify Quotation</a>
                                <?php } ?>

                                <?php if ($isActive == 1) { ?>
                                    <a class="btn btn-appointment waves-effect waves-light m-t-sm-10" href="<?php echo site_url('quotation/sendQuotationToUser') . '/' . $quotationDetail[0]->qId; ?>">Send Quotation</a>
                                <?php } else { ?>
                                    <a class="btn btn-appointment waves-effect waves-light m-t-sm-10" href="javascript:void(0)">Send Quotation</a>
<?php } ?>
                            </div>
                        </aside>
                    </article>


                    <!-- Top Secton Ends-->
                    <hr class="hr-appt-detail" />

                    <!-- Bottom Section Start -->
                    <article class="clearfix m-r-20 m-r-0 p-b-20">
                        <aside class="col-md-12 col-xs-12">
                            <section class="table-responsive">
                                
                                
                                
                                <table class="table table-borderd quotation-table">
                                    
                                
                                    <colgroup width="20%"></colgroup>
                                    
                                     <colgroup width="25%"></colgroup>
                                     
                                      <colgroup width="25%"></colgroup>
                                      
                                       <colgroup width="15%"></colgroup>
                                       
                                        <colgroup width="15%"></colgroup>
                                       
                                    <tr>
                                        <th>Category</th>
                                        <th>Test Name</th>
                                        <th>Instruction</th>
                                        <th>Pricing</th>
                                        <?php if ($isActive == 1) { ?>
                                        <th>Action</th>
                                        <?php } ?>
                                    </tr>

                                    <?php
                                    $total = '';
                                    
                                    
                                    if (isset($quotationTest) && !empty($quotationTest)) {
                                        foreach ($quotationTest as $key => $val) {
                                            $total = $total + $val->price;
                                            ?>

                                            <tr   id="<?php echo $val->testId; ?>" class="edit_tr">
                                                <td class="edit_td">
                                                    <h6 class="text" id="catName<?php echo $val->testId; ?>"><?php echo $val->catName; ?></h6>
                                                    <article id="catName_input_l<?php echo $val->testId; ?>" class="editbox" style="display:none">
                                                        <select id="catName_input_<?php echo $val->testId; ?>" class="selectpicker" data-width="100%" name="diagnosticType">
                                                            <?php
                                                            if (isset($dignoCat) && !empty($dignoCat)) {
                                                                foreach ($dignoCat as $key1 => $val1) {
                                                                    ?>

                                                                    <option <?php
                                                                    if ($val->diagnoCatId != '' && $val->diagnoCatId == $val1->catId) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?> value="<?php echo $val1->catId; ?>" ><?php echo $val1->catName; ?></option>

                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </article>
                                                </td>

                                                <td class="edit_td">
                                                    <h6 class="text" id="testName<?php echo $val->testId; ?>"><?php echo $val->testName; ?></h6>
                                                    <article class="editbox" id="testName_input_l<?php echo $val->testId; ?>" style="display:none">
                                                        <input type="text" class="form-control" id="testName_input_<?php echo $val->testId; ?>" value="<?php echo $val->testName; ?>"  />
                                                        <label class="error" style="display:none;" id="error-testName<?php echo $val->testId; ?>">Test should be alphanumeric</label>
                                                    </article>
                                                </td>

        <!--                                                <td class="edit_td">
                                                    <h6 class="date<?php echo $val->testId; ?>"><?php echo date("m/d/Y", $val->date); ?></h6>
                                                    <article class="editbox" id="date_input_<?php echo $val->testId; ?>" style="display:none">
                                                        <div  class="input-group qEdit<?php echo $val->testId; ?>" >
                                                            <input class="form-control pickDate date-3  date<?php echo $val->testId; ?>" placeholder="dd/mm/yyyy" value="<?php echo date("m/d/Y", $val->date); ?>"  type="text" name="date" onkeydown="return false;">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                    </article>
                                                </td>-->
        <!--                                                <td class="edit_td">
                                                    <h6 id="time<?php echo $val->testId; ?>"><?php echo date("h:i a", $val->date); ?></h6>
                                                    <article class="editbox" id="time_input_<?php echo $val->testId; ?>" style="display:none">
                                                        <div class="bootstrap-timepicker input-group qEdit<?php echo $val->testId; ?>" style="display:none">
                                                            <input id="timepicker4" type="text" class="form-control timepicker time<?php echo $val->testId; ?>" value="<?php echo date("h:i a", $val->date); ?>" />
                                                        </div>

                                                    </article>
                                                </td>-->

                                                <td class="edit_td">
                                                    <h6  class="text" id="instruction<?php echo $val->testId; ?>"><?php echo $val->instruction; ?></h6>
                                                    <article class="editbox" id="instruction_input_l<?php echo $val->testId; ?>" style="display:none">
                                                        <textarea id="instruction_input_<?php echo $val->testId; ?>" class="" ><?php echo $val->instruction; ?></textarea>

                                                    </article>
                                                </td>

                                                <td class="edit_td">

                                                    <h6  class="text" id="price<?php echo $val->testId; ?>"><?php echo $val->price; ?></h6>

                                                    <article class="editbox" id="price_input_l<?php echo $val->testId; ?>" style="display:none">
                                                        <input type="number" id="price_input_<?php echo $val->testId; ?>" class="form-control" value="<?php echo $val->price; ?>"  />

                                                        <label class="error" style="display:none;" id="error-price<?php echo $val->testId; ?>">Price should be a number</label>
                                                    </article>
                                                </td>

                                                <?php if ($isActive == 1) { ?>
                                                <td class="edit_td"> 
                                                   <a  onclick="deleteFn(<?php echo $val->testId; ?>)"  class="btn btn-danger btn-sm waves-effect waves-light m-tb-sm-3" href="javascript:void(0)">Delete</a>
                                                    
                                                    

                                                    
                                                    <a  id="edit<?php echo $val->testId; ?>" class="btn btn-success btn-sm waves-effect waves-light m-tb-sm-3 text" href="javascript:void(0)" >Edit</a>
                                                    
                                                    <article class="editbox" id="save_input_l<?php echo $val->testId; ?>" style="display:none">
                                                         <a class="btn btn-success btn-sm waves-effect waves-light m-tb-sm-3 qUpdateBtn<?php echo $val->testId; ?>"  onclick="return updateFn(<?php echo $val->testId; ?>);"  href="javascript:void(0)" >Update</a>
                                                         
                                                    </article>
                                                   
                                                   
                                                </td>
                                                 <?php } ?>
                                            </tr>
                                        <?php
                                        }
                                    }
                                    ?>

                                    <tr>

                                    </tr>


                                </table>
                            </section>
                            <h5 class="h5-title text-right">Tax : <?php  echo $tex = $quotationDetail[0]->tex; ?> %</h5>
                            <h5 class="h5-title text-right">Other Fee :<?php echo $otherFee = $quotationDetail[0]->otherFee; ?></h5>
                            <?php $price = $otherFee+$total; ?>
                            <h5 class="h5-title text-right">Total Quotation Amount : <?php  echo getIntrast($price,$tex); ?></h5>
                        </aside>
                    </article>


                    <!-- Bottom Secton Ends-->
                </div>
            </section>

            <!-- container -->
        </div>
        <!-- content -->
    </div>
    <!-- End Right content here -->
</div>
<!-- END wrapper -->

<style >
    .editbox
    {
        display:none
    }
    td
    {
        padding:5px;
    }
    .editbox textarea 
    {
/*        font-size:14px;
        width:270px;
        background-color:#ffffcc;
        border:solid 1px #000;
        padding:4px;*/
        height: 34px;
        border: 1px solid #ccc;
        border-radius: 2px;
    }
    
    .editbox .btn
    
     { height:33px;}
    
    .edit_tr:hover
    {
        background:url(edit.png) right no-repeat #80C8E5;
        cursor:pointer;
    }
</style>