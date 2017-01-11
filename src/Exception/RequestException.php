<?php

namespace ChiarilloMassimo\Satispay\Exception;

/**
 * Class RequestException
 * @package ChiarilloMassimo\Satispay
 */
class RequestException extends \Exception
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