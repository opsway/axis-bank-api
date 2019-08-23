<?php

declare(strict_types=1);

namespace OpsWay\Axis\Model\Encryption;

use gnupg;
use OpsWay\Axis\Exception\FileNotFoundException;
use OpsWay\Axis\Exception\InvalidFingerprintException;

/**
 * Class PGPStrategy
 *
 * @package OpsWay\Axis\Model\Encryption
 */
class PGPStrategy implements EncryptionStrategy
{
    /** @var gnupg */
    private $gpg;

    /** @var string */
    private $publicKeyPath;

    /** @var string */
    private $privateKey;

    /** @var string */
    private $fingerprint;

    /** @var string */
    private $password;

    /**
     * PGPStrategy constructor.
     *
     * @param string $publicKeyPath
     * @param string $privateKey
     * @param string $fingerprint
     * @param string $password
     *
     * @throws FileNotFoundException
     * @throws InvalidFingerprintException
     */
    public function __construct(string $publicKeyPath, string $privateKey, string $fingerprint, string $password)
    {
        // Create gnupg object for continues usage
        $this->gpg = new gnupg();
        $this->gpg->seterrormode(gnupg::ERROR_EXCEPTION);

        // Set path to public key on server
        if (file_exists($publicKeyPath) === false) {
            throw new FileNotFoundException("Public key file doesn't exist on server");
        }
        $this->publicKeyPath = $publicKeyPath;

        // Set path to public key on server
        if (file_exists($privateKey) === false) {
            throw new FileNotFoundException("Private key file doesn't exist on server");
        }
        $this->privateKey = $privateKey;

        // Check that public\private key was setup in system
        if (empty($this->gpg->keyinfo($fingerprint))) {
            throw new InvalidFingerprintException("Finger print isn't correct");
        }
        $this->fingerprint = $fingerprint;
        $this->password    = $password;
    }

    /**
     * @param string $validJsonString
     *
     * @return string
     */
    public function encrypt(string $validJsonString) : string
    {
        $this->gpg->addencryptkey($this->fingerprint);
        return $this->gpg->encrypt($validJsonString);
    }

    /**
     * @param string $pgpFormatString
     *
     * @return string
     */
    public function decrypt(string $pgpFormatString): string
    {
        $this->gpg->adddecryptkey($this->fingerprint, $this->password);
        return $this->gpg->decrypt($pgpFormatString);
    }
}
