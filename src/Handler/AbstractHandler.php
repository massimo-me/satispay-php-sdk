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
     * AbstractHandler constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
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
