<?php

namespace Paysgator\Resources;


class Payments
{
    private $client;

    public function __construct($client)
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
        try {
            $response = $this->client->getHttpClient()->post('payment/create', [
                'json' => $data,
            ]);

            if ($response->getStatusCode() >= 400) {
                throw new \Exception('API Error: ' . $response->getStatusCode());
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw $e;
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
        try {
            $response = $this->client->getHttpClient()->post('payment/confirm', [
                'json' => $data,
            ]);

            if ($response->getStatusCode() >= 400) {
                throw new \Exception('API Error: ' . $response->getStatusCode());
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
