<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;
use GuzzleHttp\Exception\GuzzleException;


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
    public function getBalance()
    {
        try {
            $response = $this->client->getHttpClient()->get('wallet/balance');

            if ($response->getStatusCode() !== 200) {
                throw new \RuntimeException('Failed to get wallet balance: ' . $response->getReasonPhrase());
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new \RuntimeException('Wallet API error: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
