<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Http\Client;
use ChiarilloMassimo\Satispay\Http\Response;

/**
 * Class AbstractHandler
 * @package ChiarilloMassimo\Satispay\Handler
 */
abstract class AbstractHandler
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param Response $response
     * @return bool
     */
    public function isResponseOk(Response $response)
    {
        return (Response::HTTP_OK === $response->getStatusCode());
    }
}
