<?php

namespace ChiarilloMassimo\Satispay\Model;

/**
 * Class AbstractEntity.
 */
abstract class AbstractEntity
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public static function makeFromObject($object)
    {
    }
}
