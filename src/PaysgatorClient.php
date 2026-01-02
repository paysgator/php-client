<?php

namespace Paysgator;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Paysgator\Resources\Auth;
use Paysgator\Resources\PaymentLinks;
use Paysgator\Resources\Subscriptions;
use Paysgator\Resources\Transactions;
use Paysgator\Resources\Wallet;

class PaysgatorClient
{
    private $client;
    private $accessToken;
    private $baseUrl = 'https://paysgator.com/api/v1/';

    public function __construct(array $config = [])
    {
        $this->baseUrl = $config['base_url'] ?? $this->baseUrl;
        $this->accessToken = $config['access_token'] ?? null;

        $guzzleConfig = [
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];

        if ($this->accessToken) {
            $guzzleConfig['headers']['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        $this->client = new Client($guzzleConfig);
    }

    public function setAccessToken($token)
    {
        $this->accessToken = $token;
        // Re-initialize client to include new token
        $config = $this->client->getConfig();
        $config['headers']['Authorization'] = 'Bearer ' . $token;
        $this->client = new Client($config);
    }

    public function getHttpClient()
    {
        return $this->client;
    }

    public function auth()
    {
        return new Auth($this);
    }

    public function paymentLinks()
    {
        return new PaymentLinks($this);
    }

    public function subscriptions()
    {
        return new Subscriptions($this);
    }

    public function transactions()
    {
        return new Transactions($this);
    }

    public function wallet()
    {
        return new Wallet($this);
    }
}
