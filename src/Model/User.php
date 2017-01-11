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
    protected $phoneNumber;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
