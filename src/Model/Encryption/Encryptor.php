<?php

declare(strict_types=1);

namespace OpsWay\Axis\Model\Encryption;

use OpsWay\Axis\Exception\NotValidJsonException;
use OpsWay\Axis\Model\Utils\Json;

class Encryptor
{
    /** @var EncryptionStrategy */
    private $strategy;

    /**
     * Encryptor constructor.
     *
     * @param EncryptionStrategy $strategy
     */
    public function __construct(EncryptionStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param EncryptionStrategy $strategy
     *
     * @return Encryptor
     */
    public function setStrategy(EncryptionStrategy $strategy) : self
    {
        $this->strategy = $strategy;
        return $this;
    }

    /**
     * @param string $jsonString
     *
     * @return string
     *
     * @throws NotValidJsonException
     */
    public function doEncrypt(string $jsonString) : string
    {
        if (Json::isValidJson($jsonString) === false) {
            throw new NotValidJsonException("Json for request hasn't valid format");
        }

        return $this->strategy->encrypt($jsonString);
    }

    /**
     * @param string $encodeString
     *
     * @return string
     */
    public function doDecrypt(string $encodeString) : string
    {
        return $this->strategy->decrypt($encodeString);
    }
}
