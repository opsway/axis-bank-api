<?php

declare(strict_types=1);

namespace OpsWay\Axis;

use OpsWay\Axis\Model\API\Beneficiary;
use OpsWay\Axis\Model\API\Payment;
use OpsWay\Axis\Model\Encryption\Encryptor;

class API
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Encryptor
     */
    private $encryptor;

    /**
     * API constructor.
     * @param Encryptor $encryptor
     */
    public function __construct(Encryptor $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        if (null === $this->client) {
            $this->setClient(new Client($this->encryptor));
        }
        return $this->client;
    }

    /**
     * @param Client $client
     *
     * @return Api
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return Payment
     */
    public function payment(): Payment
    {
        return new Payment($this->getClient());
    }

    /**
     * @return Beneficiary
     */
    public function beneficiary(): Beneficiary
    {
        return new Beneficiary($this->getClient());
    }
}
