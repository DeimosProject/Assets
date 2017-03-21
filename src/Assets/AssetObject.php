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
     * @var []
     */
    protected $properties = [];

    /**
     * @var []
     */
    protected $before = [];

    /**
     * @var []
     */
    protected $after = [];

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
                . filemtime($this->root . $this->path);
        }

        return $this->path;
    }

    /**
     * @param array $names
     *
     * @return $this
     */
    public function after(array $names)
    {
        $this->after = array_merge($this->after, $names);

        return $this;
    }

    /**
     * @param array $names
     *
     * @return $this
     */
    public function before(array $names)
    {
        $this->before = array_merge($this->before, $names);

        return $this;
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

    /**
     * @return array
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @return array
     */
    public function getAfter()
    {
        return $this->after;
    }

}
