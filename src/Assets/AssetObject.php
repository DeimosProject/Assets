<?php

namespace Deimos\Assets;

class AssetObject
{

    /**
     * @var string
     */
    protected $root;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * Object constructor.
     *
     * @param string $root
     * @param string $path
     */
    public function __construct($root, $path)
    {
        $this->root = $root . '/';
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        if (realpath($this->root . $this->path))
        {
            return $this->path
                . (0 === strpos($this->path, '?') ? '&' : '?')
                . filemtime($this->path);
        }

        return $this->path;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function setProperty($name, $value = true)
    {
        $this->properties[$name] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

}
