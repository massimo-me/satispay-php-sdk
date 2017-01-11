<?php

namespace ChiarilloMassimo\Satispay\Model;

/**
 * Class User
 * @package ChiarilloMassimo\Satispay\Model
 */
class User
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
}
