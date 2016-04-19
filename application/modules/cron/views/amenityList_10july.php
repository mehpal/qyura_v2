<!-- BEGIN CONTENT -->
<!-- BEGIN DASHBOARD STATS -->
<!--/////////////////////-->

<!-- BEGIN DASHBOARD STATS -->
<!-- BEGIN PAGE CONTENT-->
<div id="amenityEdit">
<div class="wrapper wrapper-content">
    <!--<div class="page-content">-->
        <div class="row border-bottom">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                <div class="ibox-title">
                <h5>All Amenities</h5>
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
                                <div href="#createAmenity" data-toggle="modal" class="btn-group ">
                                    <?php if($this->ion_auth->in_group(array('PM'))) { ?>
                                    <button id="" class="btn btn-primary">
                                    Add New <i class="fa fa-plus"></i>
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
                                        <?php echo $this->lang->line("amenityNameTbl");?>
                                    </th>

                                    <th>
                                        <?php echo $this->lang->line("capacityTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("openingTimeTbl");?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line("closingTimeTbl");?>
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

                                            <td><?php echo $am->amenityName;  ?></td>
                                            <td><?php echo $am->capacity;  ?></td>
                                            <td><?php echo date("g:i A",strtotime($am->openingTime));  ?></td>
                                            <td><?php echo date("g:i A",strtotime($am->closingTime));  ?></td>
                                            <td><?php echo ($am->securityAmount != 0) ? $am->securityAmount : 'N/A';  ?></td>
                                            <?php if($this->ion_auth->in_group(array('PM'))) { ?>
                                            <td class="col-md-4" id="re">
                                                <a onclick="editAmenity('<?php echo $am->amenityId;?>');" class="btn btn-success btn-xs" href="#">
                                                    <i class="fa fa-pencil-square "></i> Edit 
                                                </a>  
                                                <a  class="btn default btn-xs btn-warning" href="#" onclick="amenityImageGallary('<?php echo $am->amenityId;?>');">
                                                    <i class="fa fa-image"></i> Manage Gallery 
                                                </a>                                
                                                <?php if($am->enabled == 1){ $direction = 'up'; $color = 'primary'; }else{$direction = 'down'; $color = 'danger';}?>                                                          

                                                        <button title="Disable Amenity" type="button" onclick="enableFn('<?php echo $am->amenityId; ?>','<?php echo $am->enabled; ?>')" class="btn btn-<?php echo $color; ?> btn-xs  btn-outline "  ><i class="fa fa-arrow-<?php echo $direction; ?>"></i></button>
                                                        <button title="Delete Amenity" type="button" onclick="deleteFn('<?php echo $am->amenityId; ?>')" class="btn btn-danger btn-outline btn-xs "  ><i class="fa fa-trash-o"></i></button>
                                                        
                                                         <?php if($am->amenityStatus == 0){ $status = " out of service"; $statusColor='danger'; $icon = 'wrench';}else{$status = " Resume"; $statusColor='primary';$icon = 'gears';}?>                                                          
                        <a class="btn btn-<?php echo $statusColor; ?> btn-outline btn-xs" title=" out of order or resume services" data-toggle="modal" onclick="amenityService('<?php echo $am->amenityId ?>'); "><i class="fa fa-<?php echo $icon; ?>"></i>
                                        <?php echo $status; ?> </a>

                                            </td><?php } ?>
                                        </tr>
                                <?php 
                                    }
                                }  ?>

                                </tbody>
                            </table>
                            <?php   $this->load->view('addAmenityview');?>
                            <div id="amenityEditForm"></div>
                            <div id="amenityGallaryDiv"></div>
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
        
        
         