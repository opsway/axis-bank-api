<?php

declare(strict_types=1);

namespace OpsWay\Axis\Tests\Model\Utils;

use OpsWay\Axis\Model\Utils\Json;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{
    /**
     * @covers \OpsWay\Axis\Model\Utils\Json::isValidJson
     */
    public function testIsValidJson()
    {
        $this->assertTrue(Json::isValidJson('{"test": "test"}'));
        $this->assertTrue(Json::isValidJson('{"test": {"test": "test"}}'));
        $this->assertFalse(Json::isValidJson('{"test": test}'));
    }
}
