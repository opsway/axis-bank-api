<?php

declare(strict_types=1);

namespace OpsWay\Axis\Tests;

use OpsWay\Axis\API;
use OpsWay\Axis\Client;
use OpsWay\Axis\Exception\FileNotFoundException;
use OpsWay\Axis\Exception\InvalidFingerprintException;
use OpsWay\Axis\Exception\NotValidJsonException;
use OpsWay\Axis\Model\Encryption\Encryptor;
use OpsWay\Axis\Model\Encryption\PGPStrategy;
use PHPUnit\Framework\TestCase;

class AxisBankTest extends TestCase
{
    /**
     * @throws FileNotFoundException
     * @throws NotValidJsonException
     * @throws InvalidFingerprintException
     */
    public function testPGPFlow()
    {
        $encryptor = new Encryptor(new PGPStrategy( __DIR__ . '/publickey.asc', __DIR__ . '/privatekey.asc', 'B0BEA975287EC03031647791ED71AEF26E6FB26D', 'password'));

        $message = $encryptor->doEncrypt(json_encode(['test' => 123]));

        $decryptMessage = $encryptor->doDecrypt($message);

        self::assertEquals('{"test":123}', $decryptMessage);
        self::assertEquals(['test' => 123], json_decode($decryptMessage, true));
    }
}
