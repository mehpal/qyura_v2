
<!-- BEGIN DASHBOARD STATS -->
<!-- BEGIN PAGE CONTENT-->

<div class="wrapper wrapper-content">
    <!--<div class="page-content">-->
        <div class="row border-bottom">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                <div class="ibox-title">
                <h5>Amenity Booking List</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-toolbar">
                        <div class="row ">
                            <div class="col-md-9 ">
                                <div href="#newBooking" data-toggle="modal" class="btn-group ">
                                    <?php if($this->ion_auth->in_group(array('PM'))) { ?>
                                    <button id="" class="btn btn-primary">
                                    New Booking 
                                    </button><?php } ?>
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th>
                                        <?php echo $this->lang->line("s_noTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("imageTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("userNameTbl");?>
                                    </th>
                                     <th>
                                        <?php echo $this->lang->line("userEmailTbl");?>
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
                                <?php 
                                    if(isset($amenity) && $amenity != NULL){
                                        $count  =  0;
                                        foreach ($amenity as $am){
                                            $count ++;
                                            ?>    
                                            <tr>
                                                <td> <?php echo $count; ?></td>
                                                <td>
                                                <a href="javascript:void(0)" onclick="showImage('<?php echo $am->amenityImageUrl;?>','<?php echo $am->amenityId; ?>')" >
                                                <img width="80" height="80" alt="Amenity image" src="<?php echo $am->amenityImageUrl; ?>" class="img-thumbnail">
                                                </a></td>
                                                <td><?php echo $am->username;  ?></td>
                                                <td><?php echo $am->email;  ?></td>
                                                <td><?php echo $am->amenityName;  ?></td>
                                                <td><?php echo date("d-m-Y",strtotime($am->bookingDate)); ?></td>
                                                <td><?php echo date("H:i",strtotime($am->bookingDate)); ?></td>
                                                <td><?php echo ($am->securityAmount != 0) ? $am->securityAmount : 'N/A';  ?></td>
                                                <td>
                                                    <input type="checkbox" data-size="small" class="make-switch" checked data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"> 
                                                </td>
                                            </tr>
                                    <?php 
                                        }
                                    }  ?>
                                </tbody>
                            </table>
                            <?php   $this->load->view('addBookingview');?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    <!--</div>-->
</div>
		
	<!-- END CONTENT -->
        
        
         