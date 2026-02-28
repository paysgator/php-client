<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;
use GuzzleHttp\Exception\GuzzleException;

class Subscriptions
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Update Subscription
     *
     * @param string $id
     * @param string $action
     * @return array
     */
    public function update($id, $action)
    {
        try {
            $response = $this->client->getHttpClient()->patch("subscriptions/{$id}", [
                'json' => ['action' => $action],
            ]);

            if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
                throw new \RuntimeException('Subscription update failed with status code: ' . $response->getStatusCode());
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new \RuntimeException('HTTP request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
