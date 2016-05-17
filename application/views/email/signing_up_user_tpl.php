<!DOCTYPE html>
<html>
    <head>
        <style>
            .main {
                padding: 1%;
                border: 1px dashed;
            }
            p {
                /*border-bottom: 1px solid;*/
                margin-left: 2%;
                margin-right: 2%;
                padding: 1%;
            }
            h1 {
                margin-left: 2%;
            }
            address {
                line-height: 1.5;
            }
            .signature {
                padding-bottom: 1% !important;
                padding-left: 3% !important;
                padding-top: 1% !important;
            }
        </style>
    </head>
    <body style="width:100%; float:left; font-family:arial;">
        <div class="main" style="width:900px; margin:0px auto">
            <!--<div style="">
                <img src="<?php echo base_url(); ?>assest/img/froyologoheader.png" style="margin:30px 44%" 0px;/>
            </div>-->
            <h1 style="text-align:left; margin-top:0px;">Hey <?php echo $name; ?></h1>
            <h1 style="text-align:left; margin-top:0px;">Username <?php echo $email; ?></h1>
            <h1 style="text-align:left; margin-top:0px;">Password <?php echo $password; ?></h1>
            <p style="text-align:left">Congratulations!</p>
            <p style="text-align:left">You have been successfully signed up at Qyura.com. Now enjoy the various features of Qyura sitting back at home. </p>
            <p style="text-align:left">For any issues feel free to reach us at info@qyura.com  or give us a call at 0731-4248789 </p>
            
            <div class="signature">
                <h4 style="margin:5px 0px">Warm Regards</h4>
                <address>
                Team Qyura<br>
                Follow us here:<br>
                www.facebook.com/<br>
                www.twitter.com/<br>
                </address>
            </div>
        </div>
    </body>
</html>
