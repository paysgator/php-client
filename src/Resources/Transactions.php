<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;

class Transactions
{
    private $client;

    public function __construct(PaysgatorClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get Transaction Details
     *
     * @param string $id
     * @return array
     */
    public function get($id)
    {
        $response = $this->client->getHttpClient()->get("transactions/{$id}");

        return json_decode($response->getBody()->getContents(), true);
    }
}
