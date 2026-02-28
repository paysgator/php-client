<?php

namespace Paysgator;

use GuzzleHttp\Client;
use Paysgator\Resources\Payments;
use Paysgator\Resources\Subscriptions;
use Paysgator\Resources\Transactions;
use Paysgator\Resources\Wallet;

class PaysgatorClient
{
    private Client $client;
    private ?string $apiKey = null;
    private string $baseUrl = 'https://paysgator.com/api/v1/';

    public function __construct(array $config = [])
    {
        $this->baseUrl = $config['base_url'] ?? $this->baseUrl;
        $apiKey = $config['api_key'] ?? null;
        if ($apiKey !== null && !is_string($apiKey)) {
            throw new \InvalidArgumentException('API Key must be a string');
        }
        $this->apiKey = $apiKey;

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

    public function setApiKey(string $key)
    {
        if ($key === '') {
            throw new \InvalidArgumentException('API Key must be a non-empty string');
        }
        $this->apiKey = $key;
        $config = $this->client->getConfig();
        $config['headers']['X-Api-Key'] = $key;
        $this->client = new Client($config);
    }

    public function getHttpClient(): Client
    {
        return $this->client;
    }

    public function payments(): Payments
    {
        return new Payments($this);
    }

    public function subscriptions(): Subscriptions
    {
        return new Subscriptions($this);
    }

    public function transactions(): Transactions
    {
        return new Transactions($this);
    }

    public function wallet(): Wallet
    {
        return new Wallet($this);
    }
}
