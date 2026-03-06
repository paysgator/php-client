<?php

namespace Paysgator;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PaysgatorClient
{
    private $client;
    private $apiKey;
    private $baseUrl = 'https://paysgator.com/api/v1/';

    public function __construct(array $config = [])
    {
        // Load API key from environment variable if not provided
        $this->apiKey = $config['api_key'] ?? $_ENV['PAYS_GATOR_API_KEY'] ?? null;
        
        // Validate API key presence
        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException('API key is required. Provide it via config or PAYS_GATOR_API_KEY environment variable.');
        }
        
        $this->baseUrl = $config['base_url'] ?? $this->baseUrl;

        $guzzleConfig = [
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Api-Key' => $this->apiKey,
            ],
        ];

        $this->client = new Client($guzzleConfig);
    }


    public function getHttpClient()
    {
        return $this->client;
    }

    public function payments()
    {
        return new Payments($this->client);
    }

    public function subscriptions()
    {
        return new Subscriptions($this->client);
    }

    public function transactions()
    {
        return new Transactions($this->client);
    }

    public function wallet()
    {
        return new Wallet($this->client);
    }
}
