<?php

namespace ChiarilloMassimo\Satispay\Authorization;

/**
 * Class Bearer.
 */
class Bearer
{
    /**
     * @var string
     */
    protected $token;

    /**
     * Bearer constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @param mixed $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }
}
