<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?php echo base_url(); ?>assets/images/fevicon-m.ico" rel="shortcut icon">
    <title>Login</title>
    <link href="<?php echo base_url(); ?>assets/css/framework.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/custom-g.css" rel="stylesheet">
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
  <h1 class="text-center"><a href="#" title="logo"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" class=""></a></h1>   
</div>
</section>
</header>
<!-- header end -->


<!-- content start -->
<section class="container-fluid">  
   

          <div class="wrapper-page login-box">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" action="<?php echo base_url(); ?>index.php/auth/login" name="loginform" method="post">
                    <?php echo validation_errors();?>
                       
                    <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-danger"> <?php echo $this->session->flashdata('message') ?> </div>
                    <?php } ?>
                    
                    <div class="form-group ">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                 <input type="text" id="identity" name="identity"  required class="form-control input-lg" placeholder="Username">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-lock "></i></span>
                                 <input type="password" id="password" name="password"  required class="form-control input-lg" placeholder="Password">
                              </div>
                           </div>
                        </div>

                    <!--div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-danger">
                                <input id="remember" type="checkbox">
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div-->
                    
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-login btn-md w-lg waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    
                  </form> 
                  <hr class="dashed-hr">
                  <p class="text-center"><a href="<?php echo base_url(); ?>index.php/auth/forgot_password"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a></p>
                </div>                
            </div>
          </div>




</section>
<!-- content end -->

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
  

    
    <script src="assets/js/framework.js"></script>
   
     
</body>
</html>