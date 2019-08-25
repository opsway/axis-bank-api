<?php

declare(strict_types=1);

namespace OpsWay\Axis\Tests;

use OpsWay\Axis\API;
use OpsWay\Axis\Client;
use OpsWay\Axis\Model\API\Beneficiary;
use OpsWay\Axis\Model\API\Payment;
use OpsWay\Axis\Model\Encryption\Encryptor;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class APITest extends TestCase
{
    /**
     * @var Client|MockObject
     */
    private $client;

    /**
     * @var Encryptor|MockObject
     */
    private $encryptor;

    /**
     * @var API
     */
    private $api;

    public function setUp(): void
    {
        $this->encryptor = $this->createMock(Encryptor::class);
        $this->client    = $this->createMock(Client::class);
        $this->api       = new API($this->encryptor);
    }

    /**
     * @covers \OpsWay\Axis\API::setClient
     */
    public function testSetClient()
    {
        $this->assertEquals($this->api, $this->api->setClient($this->client));
    }

    /**
     * @covers \OpsWay\Axis\API::getClient
     */
    public function testGetClient()
    {
        $this->api->setClient(($this->client));
        $this->assertEquals($this->client, $this->api->getClient());
    }

    /**
     * @covers \OpsWay\Axis\API::payment
     */
    public function testPayment()
    {
        $payment = new Payment($this->api->getClient());
        $this->assertEquals($payment, $this->api->payment());
    }

    /**
     * @covers \OpsWay\Axis\API::beneficiary
     */
    public function testBeneficiary()
    {
        $beneficiary = new Beneficiary($this->api->getClient());
        $this->assertEquals($beneficiary, $this->api->beneficiary());
    }
}
