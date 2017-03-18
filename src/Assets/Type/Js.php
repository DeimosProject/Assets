<?php

namespace Deimos\Assets\Type;

use Deimos\Assets\Type;

class Js extends Type
{

    /**
     * @return string
     */
    public function __toString()
    {
        $path = $this->object->getPath();

        return '<script src="' .
            $path . '" ' .
            implode(' ', $this->properties())
            . '></script>';
    }

}