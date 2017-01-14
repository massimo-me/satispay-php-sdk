<?php

namespace ChiarilloMassimo\Satispay\Core;

use ChiarilloMassimo\Satispay\Model\Charge;
use ChiarilloMassimo\Satispay\Model\Refund;
use ChiarilloMassimo\Satispay\Model\User;

/**
 * Class SatispayEndpoint
 * @package ChiarilloMassimo\Satispay\Core
 */
final class SatispayEndpoints
{
    public static $entityMap = [
        User::class => '/online/v1/users',
        Charge::class => '/online/v1/charges',
        Refund::class => '/online/v1/refunds',
    ];

    /**
     * @param $class
     * @return array|mixed|null
     */
    public static function get($class)
    {
        if (array_keys(self::$entityMap, $class)) {
            return null;
        }

        return self::$entityMap[$class];
    }
}