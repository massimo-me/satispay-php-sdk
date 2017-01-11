<?php

namespace ChiarilloMassimo\Satispay\Exception;

/**
 * Class SatispayException
 * @package ChiarilloMassimo\Satispay\Exception
 */
class SatispayException extends \Exception
{
    /**
     * RequestException constructor.
     *
     * @param string $statusCode
     * @param int $message
     * @param null $code
     */
    public function __construct($statusCode, $message, $code = null)
    {
        parent::__construct(
            sprintf('[Satispay] %d: %s', $statusCode, $message),
            $code
        );
    }
}