<div class="content-page"> 
    <div class="content">
	<div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Add FAQ</h3>
                <a href="<?php echo site_url() ?>/faq/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 600px; margin: 0 auto ; background:whitesmoke;">
            <form name="faqAddForm" action="#" id="faqAddForm" method="post">
                <div class="clone">
                    <article class="clearfix m-t-10">
                        <label for="" class="control-label">Question :</label>
                        <div class="">
                            <textarea class="form-control m-t-5" id="faq_question" type="text" name="faq_question[]"><?php echo set_value('faq_question'); ?></textarea>
                            <label class="error" id="err_faq_question" > <?php echo form_error("faq_question"); ?></label>
                        </div>
                    </article>
                    <article class="clearfix m-t-10">
                        <label for="" class="control-label">Answer :</label>
                        <div class="">
                            <textarea class="form-control m-t-5" id="faq_answer" type="text" name="faq_answer[]"><?php echo set_value('faq_answer'); ?></textarea>
                            <label class="error" id="err_faq_answer" > <?php echo form_error("faq_answer"); ?></label>
                        </div>
                    </article>
                    <article class="clearfix m-t-10">
                        <label for="" class="control-label">Answer (optional)</label>
                        <div class="">
                            <textarea class="form-control m-t-5" id="faq_answer1" type="text" name="faq_answer1[]" ><?php echo set_value('faq_answer1'); ?></textarea>
                            <label class="error" id="err_faq_answer1" > <?php echo form_error("faq_answer1"); ?></label>
                        </div>
                    </article>
                </div>
                <article class="clearfix m-t-10 m-b-20">
                    <a href="#" class="add btn btn-success" rel=".clone">Add More</a>
                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                </article>
            </form>
        </div>
    </div>
