<div class="content-page"> 
    <div class="content">
	<div class="clearfix">
            <div class="col-md-12 m-t-10">
                <h3 class="pull-left page-title m-l-10">Add MI</h3>
                <a href="<?php if($this->router->fetch_method() == 'addHospital'){ echo site_url() ?>/master/mi_master/hospital/ <?php }else{ echo site_url() ?>/master/mi_master/diagnosticList/ <?php } ?>" class="btn btn-appointment btn-back waves-effect waves-light pull-right m-r-10"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="container row " style="width: 600px; margin: 0 auto ; background:whitesmoke;">
            <form name="miForm" action="#" id="miForm" method="post">
                <?php echo $this->load->view("mi_add_field"); ?>
                <article class="clearfix m-t-10 m-b-20">
                    <button class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                </article>
            </form>
        </div>
    </div>
