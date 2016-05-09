<!--	<h1><?php// echo sprintf(lang('email_activate_heading'), $identity);?></h1>
	<p><?php //echo sprintf(lang('email_activate_subheading'), anchor('api/auth/auth/activate/'. $id .'/'. $activation, lang('email_activate_link')));?></p>-->
<!DOCTYPE html>
<html>
<body style="width:100%; float:left; background:rgb(127, 251, 200); font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="<?php echo base_url(); ?>assets/images/qyura-f-l.png" style="margin:30px 40%" 0px;/>
        </div>
        <h1 style="text-align:center; margin-top:0px;">Thanks for the Registration</h1>
        <p style="text-align:center">This is just sample content. You can add your content when you create a campaign using this template. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
        <table width="600" border="1|0" cellspacing="0" cellpadding="10px" style="margin:0 auto;" borderColor="WHITE">
            <tr>
                <th  style="text-align:left">Information</th>
                <th  style="text-align:left">Detail</th>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <?php echo sprintf(lang('email_activate_heading'), $identity);?>
                </td>
            </tr>
             <tr>
                <td>
                   Contact Detail:
                </td>
                <td>
                    +91- <?php echo $mobileNo; ?>
                </td>
            </tr>
            
            <tr>
                <td>
                   OTP:
                </td>
                <td>
                    <?php echo $activationCode; ?>
                </td>
            </tr>
            
            <?php if(isset($password) && $password != null) { ?>
            <tr>
                <td>
                   Password
                </td>
                <td>
                    <?php echo $password; ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <h3 style="text-align:center">Click Below link for Activation</h3>
        <h4 style="text-align:center">
            <a style="text-align:center; background-color:#FACA66; padding:10px 18px; color:#fff; width:300px; font-weight:600; text-transform:capitalize; text-decoration:none; height:50px; border-radius:10px;" href="<?php echo site_url('api/auth/auth/activate').'/'. $id .'/'. $activation; ?>">Click for Activatin</a>
        </h4>
         <h4 style="margin:5px 0px">- Warm Regards</h4>
        
        <h4 style="margin:5px 0px">Qyura Team</h4>
        <h4 style="margin:5px 0px">Shekhar Central - Indore</h4>
        <h4 style="margin:5px 0px">9893000111</h4>
    </div>
</body>

</html>
