<?php
if(!empty($users)){ 
            $total = ''; 
            $quotationTestTable = '';

            $quotationTestTable .= '<tr> <td>
                                           <h6>'.$this->input->post('patient_email').'</h6>
                                                </td>
                                                <td>
                                                    <h6>'.$this->input->post('users_mobile').'</h6>
                                                </td>
                                                <td>
                                                    <h6>'.$this->input->post('users_username').'</h6>
                                                </td>
                                            </tr>';
             }
            

//            $quotationTestTable .= '<tr> <td colspan="6" class="text-right" style="padding-right:20px;">Total Quotation Amount :  '.$total.' </td> </tr>'; 
?>
<!DOCTYPE html>
<html>
<body style="width:100%; float:left; background:rgb(127, 251, 200); font-family:arial;">

    <div class="main" style="width:900px; margin:0px auto">

        <div style="">
            <img src="<?php echo base_url(); ?>assets/images/qyura-f-l.png" style="margin:30px 40%" 0px;/>
        </div>
        <h1 style="text-align:center; margin-top:0px;">Hello <?php echo $this->input->post('users_username'); ?></h1>
        <p style="text-align:center">New Register</p>
        <table width="600" border="1|0" cellspacing="0" cellpadding="10px" style="margin:0 auto;" borderColor="WHITE">
            <tr>
               
                        <th style="text-align:left">Email</th>
                        <th style="text-align:left">Mobile</th>
                        <th style="text-align:left">Address</th>
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
