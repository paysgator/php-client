<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;

class Subscriptions
{
    private $client;

    public function __construct(PaysgatorClient $client)
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
        if (empty($id) || !is_string($id)) {
            throw new \InvalidArgumentException('Subscription ID is required.');
        }
        if (empty($action) || !is_string($action)) {
            throw new \InvalidArgumentException('Action is required.');
        }

        try {
            $response = $this->client->getHttpClient()->patch("subscriptions/{$id}", [
                'json' => ['action' => $action],
            ]);

            if ($response->getStatusCode() >= 400) {
                throw new \RuntimeException('API request failed: ' . $response->getReasonPhrase());
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to update subscription: ' . $e->getMessage(), 0, $e);
        }
    }
}
