<?php

namespace ChiarilloMassimo\Satispay\Model;

/**
 * Class ArrayCollection.
 */
class ArrayCollection implements \Iterator
{
    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @var mixed
     */
    protected $elements;

    /**
     * @var bool
     */
    protected $more;

    /**
     * ArrayCollection constructor.
     *
     * @param array $elements
     * @param bool  $more
     */
    public function __construct(array $elements, $more = false)
    {
        $this->elements = $elements;
        $this->more = $more;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->elements[$this->position];
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->users[$this->position]);
    }
}
