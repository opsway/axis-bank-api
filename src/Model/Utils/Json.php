<?php

declare(strict_types=1);

namespace OpsWay\Axis\Model\Utils;

class Json
{
    /**
     * @param string $jsonString
     *
     * @return bool
     */
    public static function isValidJson(string $jsonString): bool
    {
        return is_string($jsonString) && is_array(json_decode($jsonString, true)) && (json_last_error() == JSON_ERROR_NONE);
    }
}
