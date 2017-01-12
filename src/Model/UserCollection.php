<?php

namespace ChiarilloMassimo\Satispay\Model;

/**
 * Class UserCollection
 * @package ChiarilloMassimo\Satispay\Model
 */
class UserCollection implements \Iterator
{
    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @var User[]
     */
    protected $users;

    /**
     * @var bool
     */
    protected $more;

    /**
     * UserCollection constructor.
     * @param array $users
     * @param bool $more
     */
    public function __construct(array $users, $more = false)
    {
        $this->users = $users;
        $this->more = $more;
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return User
     */
    public function current()
    {
        return $this->users[$this->position];
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @inheritdoc
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
