<!-- Start content -->
<div class="content">
    <div class="container">
        <!-- consultation -->
        <div style="display:show;" id="consultDiv">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">Doctor Time Slot</h3>
                    <a class="btn btn-danger waves-effect pull-right" type="button" href="<?php echo base_url().'/index.php/diagnostic/detailDiagnostic/'.$diagnosticData[0]->diagnostic_id.'/doctor'; ?>">Back</a>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-7 detailbox m-b-20">
                <aside class="bg-white">
                    <figure class="clearfix">
                        <h3>Available At</h3>
                    </figure>



                    <div class="nicescroll" style="overflow: scroll; max-height:400px;" tabindex="5004">
                        <div class="clearfix">
                            <!--                                                    <div class="clearfix m-t-20 text-center" style="width:1600px">-->
                            <div class="clearfix m-t-20 text-center" style="width:1600px">
                                <!-- outer  din start -->
                                <?php foreach ($timeSloats as $day => $sloats) { ?>
                                    <div class="clearfix m-t-20 text-center">
                                        <section class="col-md-2" style="max-width:150px;">
                                            <aside class=" text-left">

                                                <label >
                                                    <?php echo $day; ?>
                                                </label>
                                            </aside>
                                        </section>
                                        <div class="col-md-10">

                                            <article class="effects effect-1  clearfix ">
                                                <!-- inner taric -->
                                                <?php foreach ($sloats as $sloat) { ?>
                                                    <div style="" data-toggle="tooltip" data-placement="right" data-html="true" title="<h4><?php echo ucfirst($sloat->psChamberName); ?></h4><p><b>Address:</b><?php echo $sloat->address; ?></p><p><b>Consulting Fee:</b> <?php echo $sloat->price; ?></p>" class="blue-ttl img">

                                                        <div class="clearfix">
                                                            <h4><?php echo date('h:i A', strtotime($sloat->open)); ?></h4>
                                                            <h4><?php echo date('h:i A', strtotime($sloat->close)); ?></h4>
                                                        </div>
                                                        <div class="overlay1">
                                                            <?php echo $sloat->docTimeTableId; ?>
                                                            <?php echo $sloat->doctorId; ?>
                                                            <?php echo $sloat->docTimeDayId; ?>
                                                            <?php echo $sloat->day; ?>
                                                            <a href="javascript:void(0)" onclick="editTimeSloatView('<?php echo $sloat->docTimeTableId ?>', '<?php echo $sloat->doctorId ?>', '<?php echo $sloat->docTimeDayId ?>', '<?php echo $sloat->day ?>')"  class="expand" title="Edit"><i class="fa fa-pencil"></i></a>
                                                            <!-- <a class="close-overlay hidden">x</a> -->
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <!-- inner taric samapt -->
                                            </article>

                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- outer  din samapt -->

                            </div>
                            </aside>
                            </section>
                            <!-- Right Section Start -->
                            <section class="col-md-5 detailbox">
                                <div class="bg-white">
                                    <aside class="clearfix">
                                        <!-- Appointment Chart -->
                                        <figure>
                                            <h3>Add New Time slot</h3>
                                        </figure>
                                        <!-- Add Specialities -->
                                        <div id="formDabba" class="col-sm-12">
                                            <form  class="cmxform form-horizontal tasi-form avatar-form" id="timeForm" name="addDoctorSlot" method="post" action="#" novalidate="novalidate">
                                                <input type="hidden" name="doctorId" id="" value="<?php echo $doctorId; ?>" />
                                                <input type="hidden" name="docTimeTable_stayAt" id="docTimeTable_stayAt" value="1" />
                                                <input type="hidden" name="docTimeTable_MItype" id="docTimeTable_MItype" value="2" />
                                                <input type="hidden" name="docTimeTable_MIprofileId" id="docTimeTable_MIprofileId" value="<?php echo $diagnosticId; ?>" />




                                                <article class="clearfix m-t-10">

                                                    <aside class="row">
                                                        <div class="col-md-12 col-sm-12">

                                                            <label class="control-label" for="docTimeDay_day">Weekdays:</label>

                                                            <select class="m-t-5 select2" data-width="100%" name="docTimeDay_day[]"  id="docTimeDay_day" multiple="">
                                                                <?php
                                                                $days = getDay();
                                                                if (isset($days) && $days != NULL) {
                                                                    foreach ($days as $d => $dayName) {
                                                                        ?>
                                                                        <option value="<?php echo $dayName ?>"><?php echo $d ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                            <span id="err_docTimeDay_day" class="error" > <?php echo form_error("docTimeDay_day"); ?></span>
                                                        </div>
                                                    </aside>

                                                    <aside class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <aside class="checkbox checkbox-success m-t-5">
                                                                <input type="checkbox" id="selectAllDay" name="selectAllDay" class="" >
                                                                <label> Select All Days</label>
                                                            </aside>
                                                        </div>
                                                        <span id="err_day" class="error" > <?php echo form_error("day"); ?></span>
                                                    </aside>



                                                </article>

                                                <article class="clearfix  m-t-10">

                                                    <aside class="row">
                                                        <div class="col-sm-6">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input name="openingHour" class="form-control timepicker" required="" type="text" value="<?php echo set_value('openingHour'); ?>"  id="lat"   placeholder="opening Hour" />
                                                                <span id="err_openingHour" class="error" > <?php echo form_error("openingHour"); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="bootstrap-timepicker input-group w-full">
                                                                <input name="closeingHour"  type="text" value="<?php echo set_value('closeingHour'); ?>"  id="closeingHour"  class="form-control timepicker" placeholder="closing Hour"  maxlength="9"/>
                                                                <span id="err_closeingHour" class="error" > <?php echo form_error("closeingHour"); ?></span>

                                                            </div>
                                                        </div>
                                                    </aside>

                                                </article>

                                                <article class="clearfix  m-t-10">

                                                    <label class="control-label" for="fees">fees:</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i>
                                                        </span>
                                                        <input  name="fees"  type="text" value="<?php echo set_value('fees'); ?>"  id="fees"   class="form-control" placeholder="fees"  maxlength="9" onkeypress="return isNumberKey(event)"  />

                                                    </div>
                                                    <span id="err_fees" class="error" > <?php echo form_error("fees"); ?></span>
                                                </article>

                                                <article class="clearfix m-t-10 m-b-20">
                                                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                                                </article>

                                            </form>
                                        </div>
                                        <!-- Add Specialities -->
                                    </aside>
                                </div>
                            </section>
                            <!-- Right Section End -->

                        </div>
                        <!-- consultation -->
                        <!-- Right Section End -->
                    </div>
                    <!-- container -->
                    </div>
                    <script>
                        $('.gadd').on('click', function () {
                            $(this).parent().parent().parent().remove();
                        });

                        function editTimeSloatView(docTimeTableId, doctorId, docTimeDayId, day) {
                            $.ajax({
                                url: urls + 'index.php/diagnostic/editDocTimeView',
                                type: 'POST',
                                data: {'docTimeTableId': docTimeTableId, 'doctorId': doctorId, 'docTimeDayId': docTimeDayId, 'day': day},
                                beforeSend: function (xhr) {
                                    qyuraLoader.startLoader();
                                },
                                success: function (data) {
                                    var obj = $.parseJSON(data);
                                    $('#formDabba').html(obj.data);
                                    qyuraLoader.stopLoader();
                                }
                            });
                        }
                        
                        $(function () {
                            $("#selectAllDay").click(function () {
                                if ($("#selectAllDay").is(':checked')) {
                                    $("#docTimeDay_day > option").prop("selected", "selected");
                                    $("#docTimeDay_day").trigger("change");
                                } else {
                                    $("#docTimeDay_day > option").removeAttr("selected");
                                    $("#docTimeDay_day").trigger("change");
                                }
                            });

                            $("#timeForm").submit(function (event) {
                                event.preventDefault();
                                var url = '<?php echo site_url(); ?>/diagnostic/addDocTime/';
                                var formData = new FormData(this);
                                submitData(url, formData);
                                return false;
                            });

                            $("#timeForm").find(':input').change(function () {
                                var erSufix = $(this).attr('name');
                                var isArr = erSufix.indexOf('[]');
                                console.log(isArr);
                                if (isArr == -1)
                                    $('#err_' + erSufix).html('');
                                else
                                {
                                    erSufix = erSufix.slice(0, -2);
                                    $('#err_' + erSufix).html('');
                                }


                            });

                        });
                    </script>
                    <!-- content -->