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
        $response = $this->client->getHttpClient()->patch("subscriptions/{$id}", [
            'json' => ['action' => $action],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
