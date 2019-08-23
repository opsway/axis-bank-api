<?php

declare(strict_types=1);

namespace OpsWay\Axis\Model\API;

use OpsWay\Axis\Client;

class BaseApi
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * BaseApi constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
