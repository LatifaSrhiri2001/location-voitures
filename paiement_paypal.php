<?php
require 'config.php';
session_start();


$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amountValue = $_POST['amount'];
$currency = 'USD';

$amount = new \PayPal\Api\Amount();
$amount->setTotal($amountValue);
$amount->setCurrency($currency);

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);
$transaction->setDescription('Paiement pour voiture ');

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl('http://localhost/rentcar/success.php')
             ->setCancelUrl('http://localhost/rentcar/cancel.php');


$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions([$transaction])
        ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
    
    $approvalLink = $payment->getApprovalLink();
    var_dump($approvalLink);
    if ($approvalLink) {
        header('Location: ' . $approvalLink);
        exit();
    } else {
        echo "Approval link is missing.";
    }
} catch (\PayPal\Exception\PayPalConnectionException $ex) {
    echo "PayPal Connection Exception: " . $ex->getData();
} catch (Exception $ex) {
    echo "Exception: " . $ex->getMessage();
}
