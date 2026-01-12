# Paysgator PHP Client

A PHP client library for the Paysgator API.

## Installation

Install via Composer:

```bash
composer require paysgator/paysgator-php
```

## Usage

### Configuration

For most requests, you simply need to provide your API Key.

```php
require 'vendor/autoload.php';

use Paysgator\PaysgatorClient;

$client = new PaysgatorClient([
    'api_key' => 'YOUR_API_KEY',
]);
```

### Create Payment

Create a payment transaction.

```php
$paymentData = [
    'amount' => 100,
    'currency' => 'MZN',
    'payment_methods' => ['MPESA', 'CARD'],
    'returnUrl' => 'https://mysite.com/return',
];

try {
    $result = $client->payments()->create($paymentData);
    echo "Payment Link: " . $result['data']['checkoutUrl'];
    echo "Transaction ID: " . $result['data']['transactionId'];
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### Confirm Payment

Confirm a payment server-side.

```php
try {
    $confirmation = $client->payments()->confirm([
        'paymentLinkId' => 'payment_uuid',
        'paymentMethod' => 'MPESA',
        'payment_fields' => ['phoneNumber' => '841234567']
    ]);
    print_r($confirmation);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### Subscriptions

Manage subscriptions.

```php
// Pause a subscription
$client->subscriptions()->update('sub_123', 'pause');
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
