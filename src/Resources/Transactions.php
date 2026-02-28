<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;
use Exception;
use InvalidArgumentException;
use RuntimeException;


class Transactions
{
    private $client;

    public function __construct(PaysgatorClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get Transaction
     *
     * @param string $id
     * @return array
     */
    public function get($id)
    {
        if (empty($id) || !is_string($id)) {
            throw new InvalidArgumentException('Transaction ID must be a non-empty string');
        }

        try {
            $response = $this->client->getHttpClient()->get("transactions/{$id}");
        } catch (Exception $e) {
            throw new RuntimeException('Failed to fetch transaction: ' . $e->getMessage(), 0, $e);
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
