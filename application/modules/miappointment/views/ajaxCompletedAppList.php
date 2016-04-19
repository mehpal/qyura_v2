


                        <!-- Table Section Start -->
                        <article class="clearfix m-top-40 p-b-20">
                            <aside class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr class="border-a-dull">
                                            <th>Appt Id</th>
                                            <th>MI Name</th>
                                            <th>Patient Name</th>
                                            <th>Phone</th>
                                            <th>Email Id</th>
                                            <th>Action</th>
                                        </tr>
                                         <?php  if(isset($reports) && !empty($reports)){
                               foreach($reports as $key=>$val){ ?>
                                        <tr>
                                            <td>
                                                <h6><?php echo  isset($val['orderId'])?$val['orderId']:'' ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo  isset($val['miName'])?$val['miName']:'' ?></h6>
                                                <p><?php echo  isset($val['city_name'])?$val['city_name']:'' ?></p>
                                            </td>
                                            <td>
                                                <h6><?php echo  isset($val['userName'])?$val['userName']:'' ?></h6>
                                                <p><?php echo  isset($val['userGender'])?$val['userGender']:'' ?> | <?php echo  isset($val['userAge'])?$val['userAge']:'' ?></p>
                                            </td>
                                            <td>
                                                <h6><?php echo  isset($val['usersMobile'])?$val['usersMobile']:'' ?></h6>
                                            </td>
                                            <td>
                                                <h6><?php echo  isset($val['email'])?$val['email']:'' ?></h6>
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
                                         }?>

                                    </tbody>
                                </table>
                            </aside>

                        </article>
                        <!-- Table Section End -->
                        <?php
                        
                        ?>
                        <article class="clearfix m-t-20 p-b-20">
                            <ul class="list-inline list-unstyled pull-right call-pagination">
                               <?php echo $this->ajax_pagination->create_links(); ?>
                            </ul>
                            
                           
                            
                        </article>
                    
