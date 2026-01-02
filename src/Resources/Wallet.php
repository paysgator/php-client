<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;

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
        $response = $this->client->getHttpClient()->get('wallet/balance');

        return json_decode($response->getBody()->getContents(), true);
    }
}
