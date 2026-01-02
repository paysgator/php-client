<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;

class Auth
{
    private $client;

    public function __construct(PaysgatorClient $client)
    {
        $this->client = $client;
    }

    /**
     * Authenticate and get Access Token
     *
     * @param string $apiKey
     * @param string $walletId
     * @return array
     */
    public function authenticate($apiKey, $walletId)
    {
        $response = $this->client->getHttpClient()->post('auth', [
            'json' => [
                'apiKey' => $apiKey,
                'walletId' => $walletId,
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        
        if (isset($data['accessToken'])) {
            $this->client->setAccessToken($data['accessToken']);
        }

        return $data;
    }
}
