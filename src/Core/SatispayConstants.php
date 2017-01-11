<?php

namespace ChiarilloMassimo\Satispay\Core;

/**
 * Class SatispayConstants
 * @package ChiarilloMassimo\Satispay\Core
 */
final class SatispayConstants
{
    /**
     * SDK Name
     */
    const SDK_NAME = 'satispay-php-sdk';

    /**
     * SDK Version
     */
    const SDK_VERSION = 1.0;

    /**
     * Sandbox endpoint
     * @see https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#api-endpoints
     */
    const SANDBOX_ENDPOINT = 'https://staging.authservices.satispay.com';
    const LIVE_ENDPOINT = 'https://authservices.satispay.com';
}
