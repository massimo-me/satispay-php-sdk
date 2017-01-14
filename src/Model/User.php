<?php

namespace ChiarilloMassimo\Satispay\Model;

use ChiarilloMassimo\Satispay\Utils\PropertyAccess;

/**
 * Class User
 * @package ChiarilloMassimo\Satispay\Model
 */
class User extends AbstractEntity
{

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $shortName = null;

    /**
     * User constructor.
     * @param null $id
     * @param null $phoneNumber
     */
    public function __construct($id = null, $phoneNumber = null)
    {
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;
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

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     * @return $this
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'phone_number' => $this->getPhoneNumber()
        ];
    }

    /**
     * @param $object
     * @return static
     */
    public static function makeFromObject($object)
    {
        return new static(
            PropertyAccess::getValue($object, 'id'),
            PropertyAccess::getValue($object, 'phone_number')
        );
    }
}
