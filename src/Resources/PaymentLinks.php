<?php

namespace Paysgator\Resources;

use Paysgator\PaysgatorClient;

class PaymentLinks
{
    private $client;

    public function __construct(PaysgatorClient $client)
    {
        $this->client = $client;
    }

    /**
     * Create Payment Link or Direct Charge
     *
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $response = $this->client->getHttpClient()->post('payment-links', [
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
