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
    public function update(string $id, string $action): array
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Subscription ID cannot be empty');
        }
        if (empty($action)) {
            throw new \InvalidArgumentException('Action cannot be empty');
        }

        $response = $this->client->getHttpClient()->patch("subscriptions/{$id}", [
            'json' => ['action' => $action],
        ]);

        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw new \RuntimeException('API request failed with status code: ' . $response->getStatusCode());
        }

        $contents = $response->getBody()->getContents();
        $data = json_decode($contents, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
        }

        return $data;
    }
}
