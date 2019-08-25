<?php

declare(strict_types=1);

namespace OpsWay\Axis\Tests\Model\Encryption;

use gnupg;
use OpsWay\Axis\Model\Encryption\PGPStrategy;
use PHPUnit\Framework\TestCase;

class PGPStrategyTest extends TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockBuilder
     */
    private $pgp;
    /**
     * @var gnupg|\PHPUnit\Framework\MockObject\MockObject
     */
    private $gpg;

    public function setUp() : void
    {
        $this->pgp = $this->getMockBuilder(PGPStrategy::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['encrypt', 'decrypt']);
        $this->gpg = $this->createMock(gnupg::class);
    }

    /**
     * @covers \OpsWay\Axis\Model\Encryption\PGPStrategy::encrypt
     */
    public function testEncrypt()
    {
        $this->gpg->expects($this->any())
            ->method('addencryptkey')
            ->with('fingerprint');

        $this->gpg->expects($this->any())
            ->method('encrypt')
            ->willReturn('encryptString');

        $this->assertEquals('encryptString', $this->gpg->encrypt('encryptString'));
    }

    /**
     * @covers \OpsWay\Axis\Model\Encryption\PGPStrategy::decrypt
     */
    public function testDecrypt()
    {
        $this->gpg->expects($this->any())
            ->method('adddecryptkey')
            ->with('fingerprint', 'password');

        $this->gpg->expects($this->any())
            ->method('decrypt')
            ->willReturn('decryptString');

        $this->assertEquals('decryptString', $this->gpg->decrypt('decryptString'));
    }
}
