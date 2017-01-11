<?php

namespace ChiarilloMassimo\Satispay;

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Handler\BearerHandler;
use ChiarilloMassimo\Satispay\Handler\UserHandler;
use ChiarilloMassimo\Satispay\Http\Client;

/**
 * Class Satispay
 * @package ChiarilloMassimo\Satispay
 */
class Satispay
{
    /**
     * @var Bearer
     */
    protected $bearer;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Satispay constructor.
     * @param Bearer $bearer
     * @param $mode
     */
    public function __construct(Bearer $bearer, $mode)
    {
        $this->bearer = $bearer;
        $this->mode = $mode;

        $this->client = (new Client($this->isLive()))
            ->setRequestOptions(
                [
                    'headers' => [
                        'Authorization' => sprintf('Bearer %s', $this->bearer->getToken()),
                        'Content-Type' => 'application/json'
                    ],
                    'verify' => $this->isLive()
                ]
            );
    }

    /**
     * @return bool
     */
    protected function isLive()
    {
        return ('live' === $this->mode);
    }


    /**
     * @todo: Auto instance handler
     */

    /**
     * @return BearerHandler
     */
    public function getBearerHandler()
    {
        return new BearerHandler($this->client);
    }

    /**
     * @return UserHandler
     */
    public function getUserHandler()
    {
        return new UserHandler($this->client);
    }
}
