<?php

require 'vendor/autoload.php';

use Paysgator\PaysgatorClient;

$client = new PaysgatorClient([
    'base_url' => 'https://paysgator.com/api/v1/', // Optional, defaults to production
]);

$apiKey="";
$walletId="";

// Authenticate to get a new token (automatically sets it on the client)
$response = $client->auth()->authenticate($apiKey, $walletId);
$token = $response['accessToken'];

//Genrating a direct charge

$directCharge = $client->paymentLinks()->create([
    'amount' => 0.01,
    'currency' => 'MZN',
    'description' => 'Direct charge',
    'returnUrl' => 'https://mysite.com/return',
    'payment_fields'=>[
        'phoneNumber'=>'842383770'
    ],
    'methods'=>['MPESA'],
    'title'=>'Direct charge',
    'confirm'=>true
]);

print_r($directCharge);

