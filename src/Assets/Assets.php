<?php

namespace Deimos\Assets;

class Assets extends Iterator
{

    /**
     * @var Storage[]
     */
    protected $storage = [];

    /**
     * @var array
     */
    protected $allow = [
        'css' => Type\Css::class,
        'js'  => Type\Js::class
    ];

    /**
     * @var string
     */
    protected $root;

    /**
     * Assets constructor.
     *
     * @param string $root
     */
    public function __construct($root)
    {
        $this->root = $root;
    }

    /**
     * @param string $type
     *
     * @return Storage
     *
     * @throws \InvalidArgumentException
     */
    public function get($type)
    {
        if (empty($this->allow[$type]))
        {
            throw new \InvalidArgumentException('Storage `' . $type . '` not found');
        }

        if (empty($this->storage[$type]))
        {
            $this->storage[$type] = new Storage(
                $this->root,
                $this->allow[$type]
            );
        }

        return $this->storage[$type];
    }

    /**
     * @param string $type
     *
     * @return Storage
     *
     * @throws \InvalidArgumentException
     */
    public function __get($type)
    {
        return $this->get($type);
    }

}