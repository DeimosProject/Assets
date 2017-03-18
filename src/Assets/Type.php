<?php

namespace Deimos\Assets;

abstract class Type
{

    /**
     * @var AssetObject
     */
    protected $object;

    /**
     * Type constructor.
     *
     * @param AssetObject $object
     */
    public function __construct(AssetObject $object)
    {
        $this->object = $object;
    }

    /**
     * @return array
     */
    protected function properties()
    {
        $properties = [];

        foreach ($this->object->getProperties() as $property => $value)
        {
            $properties[] = $property .
                (is_bool($value) ? '' : '="' . $value . '"');
        }

        return $properties;
    }

    /**
     * @return string
     */
    abstract public function __toString();

}