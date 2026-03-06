<?php

require 'vendor/autoload.php';

use Paysgator\PaysgatorClient;

$client = new PaysgatorClient([
    'base_url' => 'https://paysgator.com/api/v1/', // Optional, defaults to production
]);

$apiKey = getenv('PAYSGATOR_API_KEY') ?: '';
$walletId = getenv('PAYSGATOR_WALLET_ID') ?: '';

// Authenticate to get a new token (automatically sets it on the client)
try {
    $response = $client->auth()->authenticate($apiKey, $walletId);
    $token = $response['accessToken'];
} catch (\Exception $e) {
    echo "Authentication Error: " . $e->getMessage() . "\n";
    exit(1);
}

// Generating a direct charge
try {
    $directCharge = $client->paymentLinks()->create([
        'amount' => 0.01,
        'currency' => 'MZN',
        'description' => 'Direct charge',
        'returnUrl' => 'https://mysite.com/return',
        'payment_fields'=>[
            'phoneNumber' => getenv('PAYSGATOR_PHONE_NUMBER') ?: '842383770'
        ],
        'methods'=>['MPESA'],
        'title'=>'Direct charge',
        'confirm'=>true
    ]);
} catch (\Exception $e) {
    echo "Payment Error: " . $e->getMessage() . "\n";
    exit(1);
}

if (isset($directCharge)) {
    print_r($directCharge);
}

