
<!-- BEGIN DASHBOARD STATS -->
<!-- BEGIN PAGE CONTENT-->
<style>
    .widget-head-color-box {
        padding-top:10px;
        height:212px;
    }
    .carousel-control.left , .carousel-control.right    {
        background-image: none !important;
    }
    .widget-text-box{
        height: 155px !important;
    }
    
</style>


<div id="amenityEdit">
<div class="wrapper wrapper-content">
    <!--<div class="page-content">-->
    <div class="row border-bottom">
        <div class="col-md-4">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
<!--            <ol class="carousel-indicators hide">
                <?php  $count= 0;
                    if(isset($amenityImages) && $amenityImages != NULL){
                        foreach($amenityImages as $amenityImg){?>
                            <li data-target="#myCarousel" data-slide-to="<?php echo $count; ?>" class="<?php echo ($count == 0) ? "active" : "";?>"></li>
                <?php      $count ++; 
                        }
                    } ?>
                </ol>
                                     Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php  $count= 0;
                    if(isset($amenityImages) && $amenityImages != NULL){
                        foreach($amenityImages as $amenityImg){?>

                    <div class="item <?php echo ($count == 0) ? "active" : "";?>">
                        <div class=" widget-head-color-box navy-bg  text-center">
                            <div class="m-b-md">
                                        <h2 class="font-bold no-margins"><?php echo $amenityImg->amenityName;?></h2>
                            </div>
                            <div class=" img-responsive text-center">
                                        <img alt="image" class="img-circle circle-border m-b-md" src="<?php echo $amenityImg->amenityImageUrl; ?>"  style="width:140px; height: 140px" />
                            </div>
                        </div>
                        <div class="widget-text-box">
                                <h4 class="media-heading"><?php echo $amenityImg->amenityName;?></h4>
                                <p><?php echo cutString($amenityImg->amenityRules);?></p>
                                <div class="text-right">
                                    
                                    <?php if($amenityImg->amenityStatus == 0){ $status = " out of service"; $statusColor='danger'; $icon = 'wrench';}else{$status = " Resume"; $statusColor='primary';$icon = 'gears';}?> 
                                    <a class="btn btn-<?php echo $statusColor; ?> btn-outline btn-xs" title=" out of order or resume services" data-toggle="modal" onclick="amenityService('<?php echo $amenityImg->amenityId ?>'); "><i class="fa fa-<?php echo $icon; ?>"></i>
                                        <?php echo $status; ?> </a>
                                    <a class="btn btn-xs btn-primary btn-outline" onclick="editAmenity('<?php echo $amenityImg->amenityId?>')">
                                        <i class="fa fa-pencil-square"></i>  &nbsp;  Edit </a>
                                </div>
                            </div>

                    </div>
                <?php       $count ++; 
                        }
                    }
                    ?>
                </div>

                <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <?php $this->load->view("BookAmenity"); ?>
        </div>
    </div>
        <div class="row border-bottom">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                <div class="ibox-title">
                <h5>Amenity Booking List</h5>
                    <div class="ibox-tools">
                        <!--<a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>-->
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-toolbar">
                        <div class="row ">
<!--                            <div class="col-md-9 ">
                                <div href="#newBooking" data-toggle="modal" class="btn-group ">
                                    <?php if($this->ion_auth->in_group(array('PM'))) { ?>
                                    <button id="" class="btn btn-primary">
                                    New Booking 
                                    </button><?php } ?>
                                </div>
                            </div>-->

                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
<!--                                    <th>
                                        <?php echo $this->lang->line("s_noTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("imageTbl");?>
                                    </th>-->
                                    <th>
                                        <?php echo $this->lang->line("userNameTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("userPhoneTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("amenityNameTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("bookingDateTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("bookingTimeTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("depositquTbl");?>
                                    </th>
                                    <?php if($this->ion_auth->in_group(array('PM'))) { ?>
                                   <th>
                                             <?php echo $this->lang->line("actionl");?>
                                    </th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                    <?php  if(isset($amenity) && $amenity != NULL){
                                $count  =  0; 
                                
                                foreach ($amenity as $am){
                                    $count ++; ?>    
                                    <tr>
                                        <td><?php echo  $am->username;  ?></td>
                                        <td><?php echo  (isset($am->bookingPhoneNo) && $am->bookingPhoneNo  != 0) ? $am->bookingPhoneNo : $am->userPhone;  ?></td>
                                        <td><?php echo $am->amenityName; ?></td>
                                        <td><?php echo date("d-m-Y H:i",strtotime($am->bookingDate)); ?></td>
                                        <td><?php echo (isset($am->bookingEnd) && $am->bookingEnd != "0000-00-00 00:00:00") ? date("H:i",strtotime($am->bookingEnd)) : date("H:i",strtotime($am->openingTime)); ?></td>
                                        <td><?php echo ($am->paymentType == 0) ? "Online" : 'By Check';  ?></td>
                                     
                                        <?php if($am->paymentType == 0)  {   ?>
                                            
                                        <td><?php echo "Payment Received";  ?></td>
                                        
                                        <?php }  else { ?>
                                        <td><?php if($am->paymentStatus == 0){ ?>
                                        <input type="checkbox" data-size="small" class="switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>" onclick="paymentStatusFn('<?php echo $am->amenityBokingId; ?>')"> <?php } else { echo "Payment Received";   }  ?>
                                        </td>
                                         <?php } ?>

                                    </tr>
                        <?php  }
                            }  ?>
                                </tbody>
                            </table>
                         
                            <div id="amenityStatusDiv"></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    <!--</div>-->
</div>
</div>		
	<!-- END CONTENT -->
        
<!--        
                                            
                                    
<input type="checkbox" data-size="small" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>" >                                       
                                    
                                      
                            <?php  //if( $am->paymentType == 0 ){   ?>
                                        <td><span class="label label-success label-sm">Payment Received</span></td>
                            <?php // } else { ?>
                                        <td>
                                            <input type="checkbox" class="make-switch" <?php// (isset($am->paymentStatus) && $am->paymentStatus == 1) ? "checked": ""; ?> data-on-color="warning" data-off-color="danger" data-on-text="&nbsp;Yes&nbsp;" data-off-text="&nbsp;No&nbsp;" onclick="paymentStatusFn('<?php// echo $am->amenityBokingId; ?>')">
                                            
                                            <input type="checkbox" class="make-switch" <?php//  (isset($am->paymentStatus) && $am->paymentStatus == 1) ? "checked": ""; ?> data-on-color="warning" data-off-color="danger" data-on-text="&nbsp;Yes&nbsp;" data-off-text="&nbsp;No&nbsp;" onclick="paymentStatusFn('<?php //echo $am->amenityBokingId; ?>')">
                                    
                                            <input type="checkbox" data-size="small" class="make-switch" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>" >                                       
                                    
                                        </td>-->
                                        
         
