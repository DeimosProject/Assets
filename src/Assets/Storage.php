<?php

namespace Deimos\Assets;

class Storage extends Iterator
{

    /**
     * @var AssetObject[]
     */
    protected $storage;

    /**
     * @var string
     */
    protected $root;

    /**
     * @var string
     */
    protected $type;

    /**
     * Storage constructor.
     *
     * @param string $root
     * @param string $type
     */
    public function __construct($root, $type)
    {
        $this->root = $root;
        $this->type = $type;
    }

    protected function makeObject($url)
    {
        return new AssetObject($this->root, $url);
    }

    /**
     * @param string $url
     *
     * @return AssetObject
     */
    public function push($url)
    {
        $this->storage[$url] = $this->makeObject($url);

        return $this->storage[$url];
    }

    /**
     * @param string $url
     *
     * @return AssetObject
     */
    public function shift($url)
    {
        $object = $this->makeObject($url);

        $this->storage = array_merge(
            [$url => $object],
            $this->storage
        );

        return $object;
    }

    /**
     * @param string $url
     */
    public function remove($url)
    {
        unset($this->storage[$url]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $toString = [];
        foreach ($this as $object)
        {
            $typeClass  = $this->type;
            $toString[] = new $typeClass($object);
        }

        return implode(PHP_EOL, $toString);
    }

}

