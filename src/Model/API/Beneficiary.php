<?php

declare(strict_types=1);

namespace OpsWay\Axis\Model\API;

class Beneficiary extends BaseApi
{
    /**
     * @param array $request
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \OpsWay\Axis\Exception\NotValidJsonException
     */
    public function create(array $request)
    {
        return $this->client->post('', $request);
    }

    /**
     * @param array $request
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \OpsWay\Axis\Exception\NotValidJsonException
     */
    public function list(array $request)
    {
        return $this->client->post('', $request);
    }
}
