<?php

declare(strict_types=1);

namespace OpsWay\Axis\Tests;

use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use OpsWay\Axis\Client;
use OpsWay\Axis\Model\Encryption\Encryptor;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Client|\PHPUnit\Framework\MockObject\MockObject
     */
    private $httpClient;

    /**
     * @var Encryptor|\PHPUnit\Framework\MockObject\MockObject
     */
    private $encryptor;

    /**
     * @var Client
     */
    private $client;

    public function setUp(): void
    {
        $this->encryptor  = $this->createMock(Encryptor::class);
        $this->httpClient = $this->createMock(BaseClient::class);
        $this->client     = new Client($this->encryptor);
    }
}
