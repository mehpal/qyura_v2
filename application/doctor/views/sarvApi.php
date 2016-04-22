<?php

$username = urlencode("u12765");
$msg_token = urlencode("Ij3aEZ");
$sender_id = urlencode("Mysarv"); // optional (compulsory in transactional sms)
$message = urlencode("dgdfgdf");
$mobile = urlencode("7566643335");

$api = "http://manage.sarvsms.com/api/send_transactional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile."";

$result_string = file_get_contents($api);
$result = json_decode($result_string, TRUE);