<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful'] 	  	 = 'Account Successfully Created';
$lang['account_creation_unsuccessful'] 	 	 = 'Unable to Create Account';
$lang['account_creation_duplicate_email'] 	 = 'Email Already Used or Invalid';
$lang['account_creation_duplicate_mobile'] 	 = 'Mobile No Already Used or Invalid';
$lang['account_creation_duplicate_username'] = 'Username Already Used or Invalid';
$lang['account_creation_missing_default_group'] = 'Default group is not set';
$lang['account_creation_invalid_default_group'] = 'Invalid default group name set';


// Password
$lang['password_change_successful'] 	 	 = 'Password Successfully Changed';
$lang['password_change_unsuccessful'] 	  	 = 'Unable to Change Password';
$lang['forgot_password_successful'] 	 	 = 'Password Reset SMS & Email Sent';
$lang['forgot_password_unsuccessful'] 	 	 = 'Unable to Reset Password';
$lang['forgot_password_active_unsuccessful'] 	 = 'This account has not been activated. Please check your email for the activation instructions.';

$lang['forgot_password_otp_active_unsuccessful'] 	 = 'Please first enter your OTP code.';

// Activation
$lang['activate_successful'] 		  	     = 'Account Activated';
$lang['otp_activate_successful'] 		     = 'Account Activated By OTP';
$lang['activate_unsuccessful'] 		 	     = 'Unable to Activate Account';
$lang['otp_activate_unsuccessful'] 		     = 'Unable to Activate Account By OTP';
$lang['otp_expired']                                 = 'Unable to Activate Account By OTP Because OTP is expired';
$lang['deactivate_successful'] 		  	     = 'Account De-Activated';
//$lang['otp_successful'] 		  	     = 'Account OTP Created';
$lang['otp_successful'] 		  	     = 'OTP has been sent on your mobile no';
$lang['deactivate_unsuccessful'] 	  	     = 'Unable to De-Activate Account';

$lang['otp_unsuccessful']                            = 'Unable to create OTP';

$lang['otp_message']                                = 'Qyura OTP code: %s';

$lang['mobile_forgot_password']                     = 'Qyura your password is: %s';


$lang['activation_email_successful'] 	  	 = 'Activation Email Sent';
$lang['activation_email_unsuccessful']   	 = 'Unable to Send Activation Email';

// Login / Logout
$lang['login_successful'] 		  	         = 'You have successfully logged in';
$lang['login_unsuccessful'] 		  	     = 'Please provide the correct login detail';
$lang['login_unsuccessful_not_active'] 		 = 'Account is inactive';
$lang['login_unsuccessful_not_active_custom'] 		 = "We've sent an email to '{replace}' Open it up to activate your account";

$lang['login_unsuccessful_not_active_otp_custom'] 		 = "We've sent OTP an SMS to '{replace}' Open it up to activate your account";

$lang['login_timeout']                       = 'Temporarily Locked Out.  Try again later.';
$lang['logout_successful'] 		 	         = 'Logged Out Successfully';

// Account Changes
$lang['update_successful'] 		 	         = 'Account Information Successfully Updated';
$lang['update_patient_successful'] 		 	         = 'Patient Information Successfully Updated';
$lang['update_unsuccessful'] 		 	     = 'Unable to Update Account Information';
$lang['update_patient_unsuccessful'] 		 	     = 'Unable to Update Patient Information';
$lang['delete_successful']               = 'User Deleted';
$lang['delete_unsuccessful']           = 'Unable to Delete User';

// Groups
$lang['group_creation_successful']  = 'Group created Successfully';
$lang['group_already_exists']       = 'Group name already taken';
$lang['group_update_successful']    = 'Group details updated';
$lang['group_delete_successful']    = 'Group deleted';
$lang['group_delete_unsuccessful'] 	= 'Unable to delete group';
$lang['group_delete_notallowed']    = 'Can\'t delete the administrators\' group';
$lang['group_name_required'] 		= 'Group name is a required field';
$lang['group_name_admin_not_alter'] = 'Admin group name can not be changed';

// Activation Email
$lang['email_activation_subject']            = 'Account Activation';
$lang['email_activate_heading']    = 'Activate account for %s';
$lang['email_activate_subheading'] = 'Please click this link to %s.';
$lang['email_activate_link']       = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Forgotten Password Verification';
$lang['email_forgot_password_heading']    = 'Reset Password for %s';
$lang['email_forgot_password_subheading'] = 'Please click this link to %s.';
$lang['email_forgot_password_link']       = 'Reset Your Password';

// New Password Email
$lang['email_new_password_subject']          = 'New Password';
$lang['email_new_password_heading']    = 'New Password for %s';
$lang['email_new_password_subheading'] = 'Your password has been reset to: %s';
