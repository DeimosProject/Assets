<?php

namespace Deimos\Assets\Type;

use Deimos\Assets\Type;

class Css extends Type
{

    /**
     * @return string
     */
    public function __toString()
    {
        return
            '<link rel="stylesheet" href="' . $this->object->getPath().
            '" ' . implode(' ', $this->properties()) . '/>';
    }

}