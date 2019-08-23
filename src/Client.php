<?php

declare(strict_types=1);

namespace OpsWay\Axis;

use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Psr7\Request;
use OpsWay\Axis\Model\Encryption\Encryptor;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private const ENDPOINT = '';
    /**
     * @var BaseClient
     */
    private $httpClient;
    /**
     * @var Encryptor
     */
    private $encryptor;

    public function __construct(Encryptor $encryptor)
    {
        $requestOptions   = [];
        $this->httpClient = new BaseClient($requestOptions);
        $this->encryptor  = $encryptor;
    }

    /**
     * @param string $url
     * @param array $data
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception\NotValidJsonException
     */
    public function post(string $url, array $data) : array
    {
        // Prepare encrypted message
        $encryptedBody = $this->encryptor->doEncrypt(
            json_encode($data)
        );

        return $this->processResult(
            $this->httpClient->send(
                new Request('POST', self::ENDPOINT . $url, [], $encryptedBody)
            )
        );
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    public function processResult(ResponseInterface $response): array
    {
        // Get decrypted message
        $responseMessage = $response->getBody()->getContents();

        // Try decrypt message
        return json_decode($this->encryptor->doDecrypt($responseMessage), true);
    }
}
