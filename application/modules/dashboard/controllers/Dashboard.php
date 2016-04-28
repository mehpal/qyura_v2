<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
           // Storing submitted values
		/*	$sender_email = 'hospital1qyura@gmail.com';
			$user_password = 'qyura123';
			$receiver_email = 'hemantrawat.mobileappz@gmail.com';
			$username = 'hemant';
			$subject = 'smtp test';
			$message = 'done';

			// Configure email library
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = $sender_email;
			$config['smtp_pass'] = $user_password;

			// Load email library and passing configured values to email library
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// Sender email address
			$this->email->from($sender_email, $username);
			// Receiver email address
			$this->email->to($receiver_email);
			// Subject of email
			$this->email->subject($subject);
			// Message in email
			$this->email->message($message);

			if ($this->email->send()) {
			 echo $data['message_display'] = 'Email Successfully Send !';
			} else {
			 echo $data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
			} */
			//require 'class.phpmailer.php';
			//require APPPATH . 'third_party/phpmailer/libraries/class.phpmailer.php';
			//require APPPATH . 'third_party/phpmailer/libraries/PHPMailerAutoload.php';

			$this->load->library('email');

            $subject = 'This is a test';
            $message = '<p>This message has been sent for testing purposes.</p>';

            // Get full html:
				            $body =
				'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
				    <title>'.html_escape($subject).'</title>
				    <style type="text/css">
				        body {
				            font-family: Arial, Verdana, Helvetica, sans-serif;
				            font-size: 16px;
				        }
				    </style>
				</head>
				<body>
				'.$message.'
				</body>
				</html>';
            // Also, for getting full html you may use the following internal method:
            $body = $this->email->full_html($subject, $message);

            $result = $this->email
                ->from('hospital1qyura@gmail.com')
                ->reply_to('hospital1qyura@gmail.com')    // Optional, an account where a human being reads.
                ->to('hemantrawat.mobileappz@gmail.com')
                ->subject($subject)
                ->message($body)
                ->send();

            var_dump($result);
            echo '<br />';
            echo $this->email->print_debugger();

            exit; 


             /* $config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',
				  'smtp_port' => 465,
				  'smtp_user' => 'hospital1qyura@gmail.com', // change it to yours
				  'smtp_pass' => 'qyura123', // change it to yours
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap' => TRUE
				);  */
 
       /* $message = '';
        $this->load->library('email');
      $this->email->set_newline("\r\n");
      $this->email->from('hospital1qyura@gmail.com'); // change it to yours
      $this->email->to('hematrawat.mobileappz@gmail.com');// change it to yours
      $this->email->subject('Resume from JobsBuddy for your Job posting');
      $this->email->message($message);
      if($this->email->send())
     {
         echo 'Email sent.';
     }
     else
    {
        show_error($this->email->print_debugger());
    } */


	}
 public function docdashboard()
	{
            echo "Doctor Dashboard";
            $this->Common_model->mypermission("4");
            $this->load->super_admin_template('Doctor_dashboard');
            
        }
        public function midashboard()
	{
            echo "MI Dashboard";
            $this->Common_model->mypermission("3");
            $this->load->super_admin_template('Mi_dashboard');
            
        }
        public function sadashboard()
	{
            echo "Super Admin Dashboard";
            $this->Common_model->mypermission("7");
            $this->load->super_admin_template('superadmin_dashboard');
            
        }
}
