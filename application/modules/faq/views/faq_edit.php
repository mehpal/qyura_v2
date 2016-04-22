<div class="content-page"> 
    <div class="content">
	<div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Edit FAQ</h3>
                <a href="<?php echo site_url() ?>/faq/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 600px; margin: 0 auto ; background:whitesmoke;">
            <?php if(isset($faq_data) && $faq_data != NULL){ ?>
            <form name="faqEditForm" action="#" id="faqEditForm" method="post">
                <input type="hidden" id="faq_id" name="faq_id" value="<?php echo $faq_data->faq_id; ?>" >
                <article class="clearfix m-t-10">
                    <label for="" class="control-label">Question :</label>
                    <div class="">
                        <textarea class="form-control m-t-5" id="faq_question" type="text" name="faq_question" required=""><?php if($faq_data->faq_question){ echo $faq_data->faq_question; }else{ echo set_value('faq_question'); } ?></textarea>
                        <label class="error" id="err_faq_question" > <?php echo form_error("faq_question"); ?></label>
                    </div>
                </article>
                <article class="clearfix m-t-10">
                    <label for="" class="control-label">Answer :</label>
                    <div class="">
                        <textarea class="form-control m-t-5" id="faq_answer" type="text" name="faq_answer" required=""><?php if($faq_data->faq_answer){ echo $faq_data->faq_answer; }else{ echo set_value('faq_answer'); }?></textarea>
                        <label class="error" id="err_faq_answer" > <?php echo form_error("faq_answer"); ?></label>
                    </div>
                </article>
                <article class="clearfix m-t-10">
                    <label for="" class="control-label">Answer (optional)</label>
                    <div class="">
                        <textarea class="form-control m-t-5" id="faq_answer1" type="text" name="faq_answer1" ><?php if($faq_data->faq_answer1){ echo $faq_data->faq_answer1; }else{ echo set_value('faq_answer1'); } ?></textarea>
                        <label class="error" id="err_faq_answer1" > <?php echo form_error("faq_answer1"); ?></label>
                    </div>
                </article>
                <article class="clearfix m-t-10 m-b-20">
                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Update</button>
                </article>
            </form>
            <?php } ?>
        </div>
    </div>
