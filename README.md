# Paysgator PHP Client

A PHP client library for the Paysgator API.

## Installation

Install via Composer:

```bash
composer require paysgator/paysgator-php
```

## Usage

### Authentication

For most requests, you need to authenticate first or provide an access token.

```php
require 'vendor/autoload.php';

use Paysgator\PaysgatorClient;

$client = new PaysgatorClient([
    'base_url' => 'https://paysgator.com/api/v1/', // Optional, defaults to production
]);

// Authenticate to get a new token (automatically sets it on the client)
$response = $client->auth()->authenticate('YOUR_API_KEY', 'YOUR_WALLET_ID');
echo "Access Token: " . $response['accessToken'];

// OR initialize with an existing token
$client = new PaysgatorClient([
    'access_token' => 'YOUR_EXISTING_TOKEN',
]);
```

### Payment Links

Create a payment link or perform a direct charge.

```php
$paymentData = [
    'title' => 'My Product',
    'amount' => 100,
    'currency' => 'MZN',
    'description' => 'Payment for services',
    'returnUrl' => 'https://mysite.com/return',
    // ... other fields
];

try {
    $link = $client->paymentLinks()->create($paymentData);
    echo "Payment Link: " . $link['url'];
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### Subscriptions

Manage subscriptions.

```php
// Pause a subscription
$client->subscriptions()->update('sub_123', 'pause');

// Resume
$client->subscriptions()->update('sub_123', 'resume');

// Cancel
$client->subscriptions()->update('sub_123', 'cancel');
```

### Transactions

Retrieve transaction details.

```php
$transaction = $client->transactions()->get('txn_123');
print_r($transaction);
```

### Wallet

Check wallet balance.

```php
$balance = $client->wallet()->getBalance();
echo "Balance: " . $balance['balance'] . " " . $balance['currency'];
```

## Support

For issues and support, please contact info@paysgator.com.
