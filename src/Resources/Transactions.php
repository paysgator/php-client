<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;
use GuzzleHttp\Exception\RequestException;


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
        try {
            $response = $this->client->getHttpClient()->get("transactions/{$id}");

            if ($response->getStatusCode() >= 400) {
                throw new RequestException('API Error', $response->getRequest(), $response);
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
