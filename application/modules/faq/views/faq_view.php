<!-- Start right Content here -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-12">
                    <h3 class="pull-left page-title">FAQ</h3>
                    <a href="<?php echo site_url() ?>/faq/addFaq/" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <!-- Left Section Start -->
            <section class="col-md-10 detailbox m-b-20 col-sm-offset-1">
                <aside class="bg-white">
                    <div class="nicescroll mxh-400" style="overflow: hidden;" tabindex="5000">
                        <div class="col-sm-12 p-t-20 p-b-20">
                            <?php if(isset($faq_list) && $faq_list != NULL){ 
                                foreach ($faq_list as $faq){
                                    //for($i=1;$i<=20;$i++){ ?>
                                <article class="clearfix degrees membership-plan">
                                    <aside class="col-lg-9 col-sm-9 col-xs-9">
                                        <?php echo $faq->faq_question; ?>
                                    </aside>
                                    <aside class="col-lg-3 col-sm-3 col-xs-3">
                                        <a class="btn btn-success waves-effect waves-light m-b-5" href="<?php echo site_url('faq/editFaqView/' . $faq->faq_id); ?>"><i class="fa fa-pencil"></i></a>
                                        <button onclick="enableFn('faq', 'faqPublish', '<?php echo $faq->faq_id; ?>','<?php echo $faq->status; ?>')" title='<?php if($faq->status == 2){ echo "Publish"; }else{ echo "Unpublish"; } ?> FAQ' type="button" class="btn btn-success waves-effect waves-light m-b-5"><i class="fa fa-thumbs-<?php if($faq->status == 3){ echo "up"; }else{ echo "down danger"; } ?>"></i></button>
                                        
                                    </aside>
                                </article>
                            <?php //} 
                            } }?>
                        </div>
                    </div>
                </aside>
            </section>
            <!-- Left Section End -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->