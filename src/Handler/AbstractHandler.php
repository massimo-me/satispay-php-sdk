<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Http\Client;

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
}
