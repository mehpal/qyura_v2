<?php if(!empty($allTest)){ 
            $total = ''; 
            $quotationTestTable = '';
            foreach ($allTest as $key => $value) { $total = $total + $value->price;
                $quotationTestTable .= '<tr> <td>
                                           <h6>'.$value->catName.'</h6>
                                                </td>
                                                <td>
                                                    <h6>'.$value->testName.'</h6>
                                                </td>
                                                <td>
                                                    <h6>'.date("m/d/Y",$value->date).'</h6>
                                                </td>
                                                <td>
                                                    <h6>'.date("h:i a",$value->date).'</h6>
                                                </td>

                                                <td>
                                                    <h6>'.$value->instruction.'</h6>
                                                </td>
                                                <td>
                                                    <h6>'.$value->price.'</h6>
                                                </td>
                                            </tr>';
            } }
            
            $quotationTestTable .= '<tr> <td colspan="6" class="text-right" style="padding-right:20px;">Total Quotation Amount :  '.$total.' </td> </tr>'; 
?>


<!--	<h1><?php// echo sprintf(lang('email_activate_heading'), $identity);?></h1>
	<p><?php //echo sprintf(lang('email_activate_subheading'), anchor('api/auth/auth/activate/'. $id .'/'. $activation, lang('email_activate_link')));?></p>-->
<!DOCTYPE html>
<html>
<body style="width:100%; float:left; background:rgb(127, 251, 200); font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="<?php echo base_url(); ?>assets/images/qyura-f-l.png" style="margin:30px 40%" 0px;/>
        </div>
        <h1 style="text-align:center; margin-top:0px;">Hello <?php echo $userDetail[0]->pName; ?></h1>
        <p style="text-align:center">Below is the quotation for the tests you have asked for.</p>
        <table width="600" border="1|0" cellspacing="0" cellpadding="10px" style="margin:0 auto;" borderColor="WHITE">
            <tr>
               
                        <th style="text-align:left">Category</th>
                        <th style="text-align:left">Test Name</th>
                        <th style="text-align:left">Date</th>
                        <th style="text-align:left">Time</th>
                        <th style="text-align:left">Instruction</th>
                        <th style="text-align:left">Pricing</th>
            </tr>
             <?php echo $quotationTestTable; ?>
        </table>
        <div style="margin-left:150px;">
            <h4 style="margin:5px 0px">- Warm Regards</h4>

           <h4 style="margin:5px 0px">Qyura Team</h4>
           <h4 style="margin:5px 0px">Shekhar Central - Indore</h4>
           <h4 style="margin:5px 0px">9893000111</h4>
        </div>
    </div>
</body>

</html>
