<?php defined('BASEPATH') OR exit('No direct script access allowed');


// Live
$config['host'] = 'gateway.push.apple.com';

// Sandbox
$config['host'] = 'gateway.sandbox.push.apple.com';

// Certificate
$config['cert'] = str_replace("/system","",BASEPATH).'assets/PushAssets/QyuraDev.pem';

// Root Certificate Autority to verify the Apple remote peer
$config['authCert'] = str_replace("/system","",BASEPATH).'assets/PushAssets/entrust_root_certification_authority.pem';

 
