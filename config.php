<?php
require 'vendor/autoload.php';  

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        '',   
        ''         
    )
);


$apiContext->setConfig(
    array(
        'mode' => 'sandbox',  
        'log.LogEnabled' => true,
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'DEBUG', 
        'cache.enabled' => true,
    )
);
?>
