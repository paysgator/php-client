<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;
use GuzzleHttp\Exception\RequestException;


class Wallet
{
    private $client;

    public function __construct(PaysgatorClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get Wallet Balance
     *
     * @return array
     */
    public function getBalance(): array
    {
        try {
            $response = $this->client->getHttpClient()->get('wallet/balance');
            $data = json_decode($response->getBody()->getContents(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \RuntimeException('Invalid JSON response from API');
            }

            return $data;
        } catch (RequestException $e) {
            throw new \RuntimeException('API Request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
