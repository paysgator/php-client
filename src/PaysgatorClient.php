<?php

namespace Paysgator;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Paysgator\Resources\Payments;
use Paysgator\Resources\Subscriptions;
use Paysgator\Resources\Transactions;
use Paysgator\Resources\Wallet;

class PaysgatorClient
{
    private $client;
    private $apiKey;
    private $baseUrl = 'https://paysgator.com/api/v1/';

    public function __construct(array $config = [])
    {
        $this->baseUrl = $config['base_url'] ?? $this->baseUrl;
        $this->apiKey = $config['api_key'] ?? null;

        $guzzleConfig = [
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];

        if ($this->apiKey) {
            $guzzleConfig['headers']['X-Api-Key'] = $this->apiKey;
        }

        $this->client = new Client($guzzleConfig);
    }

    public function setApiKey($key)
    {
        $this->apiKey = $key;
        $config = $this->client->getConfig();
        $config['headers']['X-Api-Key'] = $key;
        $this->client = new Client($config);
    }

    public function getHttpClient()
    {
        return $this->client;
    }

    public function payments()
    {
        return new Payments($this);
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
