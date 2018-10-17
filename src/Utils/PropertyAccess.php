<?php

namespace ChiarilloMassimo\Satispay\Utils;

/**
 * Class PropertyAccess.
 */
class PropertyAccess
{
    /**
     * @param $object
     * @param $property
     *
     * @return null|mixed
     */
    public static function getValue($object, $property)
    {
        if (!is_object($object) || !property_exists($object, $property)) {
            return null;
        }

        return $object->$property;
    }
}
