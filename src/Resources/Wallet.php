<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class Wallet
{
    private $client;

    public function __construct(PaysgatorClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get Wallet Balance
     *
     * @return array
     */
    public function getBalance(): array
    {
        try {
            $response = $this->client->getHttpClient()->get('wallet/balance');
            $contents = $response->getBody()->getContents();
            $data = json_decode($contents, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response from API: ' . json_last_error_msg());
            }

            if (!is_array($data)) {
                throw new Exception('Unexpected response format from wallet balance API');
            }

            return $data;
        } catch (GuzzleException $e) {
            throw new Exception('Wallet API request failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
