<?php

namespace Deimos\Assets;

class Storage extends Iterator
{

    /**
     * @var AssetObject[]
     */
    protected $storage = [];

    /**
     * @var string
     */
    protected $root;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $sort = [];

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
     * @param string $name
     *
     * @return AssetObject
     */
    public function push($url, $name = null)
    {
        $index = count($this->storage);

        $this->storage[$index]       = $this->makeObject($url);
        $this->sort[$name ?: $index] = $index;

        return $this->storage[$index];
    }

    /**
     * @param string $url
     * @param string $name
     *
     * @return AssetObject
     */
    public function shift($url, $name = null)
    {
        $index  = count($this->storage);
        $object = $this->makeObject($url);

        $this->sort[$name ?: $index] = $index;
        $this->storage += [$index => $object];

        return $object;
    }

    /**
     * @param string $keySearch
     * @param string $newKey
     * @param mixed  $value
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    protected function swap($keySearch, $newKey, $value)
    {
        if (!array_key_exists($keySearch, $this->storage))
        {
            throw new \InvalidArgumentException('Key `' . $keySearch . '` not found!');
        }

        $key = array_search($keySearch, $this->sort, true);
        unset($this->sort[$newKey]);
        unset($this->sort[$key]);

        $this->sort[$key]    = $keySearch;
        $this->sort[$newKey] = $value;

        return $this;
    }

    /**
     * before to string
     */
    protected function sort()
    {
        foreach ($this->storage as $key => $object)
        {
            foreach ($object->getAfter() as $item)
            {
                if ($key < $this->sort[$item])
                {
                    $this->swap($key, $item, $this->sort[$item]);
                }
            }

            foreach ($object->getBefore() as $item)
            {
                if ($key > $this->sort[$item])
                {
                    $this->swap($key, $item, $this->sort[$item]);
                }
            }
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $toString = [];
        $this->sort();

        foreach ($this->sort as $iterator)
        {
            $object     = $this->storage[$iterator];
            $typeClass  = $this->type;
            $toString[] = new $typeClass($object);
        }

        return implode(PHP_EOL, $toString);
    }

}

