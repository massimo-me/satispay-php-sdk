<?php

namespace ChiarilloMassimo\Satispay;

use ChiarilloMassimo\Satispay\Core\SatispayConstants;
use GuzzleHttp\Client as BaseClient;

/**
 * Class Client
 * @package ChiarilloMassimo\Satispay\Core
 */
class Client extends BaseClient
{
    /**
     * Client constructor.
     * @param array $isLive
     * @param array $config
     */
    public function __construct($isLive, array $config = [])
    {
        parent::__construct(
            $config + [
                'base_uri' => ($isLive) ? SatispayConstants::LIVE_ENDPOINT : SatispayConstants::SANDBOX_ENDPOINT
            ]
        );
    }
}
