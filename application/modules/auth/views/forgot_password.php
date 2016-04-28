<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url(); ?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Forgot-Password</title>
    <link href="<?php echo base_url(); ?>assets/css/framework.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/custom-g.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/jquery.js">


    
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>


</head>
<body>
<div id="wrap" class="body-dark">

<!-- header start -->
<header class="container-fluid navbar-default">
<section class="container">
<div class="clearfix">
  <h1 class="text-center"><a href="#" title="logo"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" class="hidden-xs"></a></h1>   
</div>
</section>
</header>
<!-- header end -->


<!-- content start -->
<section class="container-fluid"> 


        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-body">
                 <form method="post" action="<?php echo base_url(); ?>index.php/auth/forgot_password" role="form" class="text-center" method="post">
                     
                   <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-danger"> <?php echo $this->session->flashdata('message') ?> </div>
                    <?php } ?>
                    <div class="alert alert-info alert-dismissable">
                        <a type="button" href="#" onclick="javascript:$(this).parent().remove();" class="close" data-dismiss="alert" aria-hidden="true">×</a>
                        Enter your <b>Email</b> and instructions will be sent to you!
                    </div>
                    <div class="form-group"> 
                      
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                            <input type="email" class="form-control input-lg" placeholder="Enter Email" required="" name="email" id="email"> 
                            <span class="input-group-btn"> <button type="submit" class="btn btn-md w-md btn- frgt-btn waves-effect waves-light">Reset</button> </span>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

   
</section>
<!-- content end -->
<div id="push"></div>
</div>




<!-- footer start -->
<footer class="container-fluid">
<section class="container">
<center class="row">
   
 
        <p>&copy; 2015 Qyura | All Right Reserved</p>
 
 
</center>
</section>
</footer> 
<!-- footer end -->
    

    
     
</body>
</html>