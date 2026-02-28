<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;
use Exception;

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
    public function create(array $data)
    {
        if (empty($data)) {
            throw new Exception('Payment data cannot be empty');
        }
        try {
            $response = $this->client->getHttpClient()->post('payment/create', [
                'json' => $data,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            throw new Exception('Failed to create payment: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Confirm Payment
     *
     * @param array $data
     * @return array
     */
    public function confirm(array $data)
    {
        if (empty($data)) {
            throw new Exception('Payment data cannot be empty');
        }
        try {
            $response = $this->client->getHttpClient()->post('payment/confirm', [
                'json' => $data,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            throw new Exception('Failed to confirm payment: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
