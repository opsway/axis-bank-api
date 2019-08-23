<?php

declare(strict_types=1);

namespace OpsWay\Axis\Model\Encryption;

/**
 * Interface EncryptionStrategy
 *
 * @package OpsWay\Axis\Model\Encryption
 */
interface EncryptionStrategy
{
    public function encrypt(string $validJsonString);

    public function decrypt(string $encryptFormatString);
}
