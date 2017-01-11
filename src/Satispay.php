<?php

namespace ChiarilloMassimo\Satispay;

use ChiarilloMassimo\Satispay\Authorization\Bearer;

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

        $this->client = new Client($this->isLive());
    }

    /**
     * @return bool
     */
    protected function isLive()
    {
        return ('live' === $this->mode);
    }

    /**
     * @return bool
     */
    public function isAuthorized()
    {
        return $this->client->get(
            '/wally-services/protocol/authenticated',
            [
                'headers' => [
                    'Authorization' => sprintf('Bearer %s', $this->bearer->getToken())
                ],
                'verify' => $this->isLive()
            ]
        );
    }
}
