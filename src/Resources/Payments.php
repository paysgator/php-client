<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class Payments
{
    private $client;

    public function __construct(PaysgatorClient $client)
    {
        $this->client = $client;
    }

    /**
     * Create Payment
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $response = $this->client->getHttpClient()->post('payment/create', [
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Confirm Payment
     *
     * @param array $data
     * @return array
     */
    public function confirm(array $data): array
    {
        $response = $this->client->getHttpClient()->post('payment/confirm', [
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
