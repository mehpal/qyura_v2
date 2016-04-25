<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url();?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Qyura | <?php if(isset($title) && !empty($title)): echo ucwords($title); endif; ?></title>
    <link href="<?php echo base_url();?>assets/css/framework.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-g.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom-r.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendor/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/vendor/select2/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/responsive-r.css" rel="stylesheet" />
    <!-- DataTables -->
    <link href="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
    <link href="<?php echo base_url();?>assets/vendor/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
</head>
<body>

<div class="container">
<!-- Bootstrap FAQ - START -->
<div class="container">
    <br />
    <br />
    <br />
    <div class="panel-group" id="accordion">
        <div class="faqHeader text-center">FAQ</div>
        <?php $count = 1; if(isset($faq_list) && $faq_list){
            foreach ($faq_list as $faq){ ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $count; ?>"><?php echo $faq->faq_question; ?> ?</a>
                    </h4>
                </div>
                <div id="collapse<?php echo $count; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $faq->faq_answer; ?>
                        <br><br>
                        <?php echo $faq->faq_answer1; ?>
                    </div>
                </div>
            </div>
        <?php $count++;} } ?>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/jquery-1.8.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/framework.js"></script>

<!--     <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/bootbox/bootbox.min.js"></script>
<style>
    .faqHeader {
        font-size: 27px;
        margin: 20px;
    }
    
    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        float: right;
        color: #F58723;
        font-size: 18px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
</style>

<!-- Bootstrap FAQ - END -->

</div>

</body>
</html>
