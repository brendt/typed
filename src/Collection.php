<?php declare(strict_types=1);

namespace Spatie\Typed;

use ArrayAccess;
use Countable;
use Iterator;

class Collection implements ArrayAccess, Iterator, Countable
{
    use ValidatesType;

    /** @var \Typed\Types\Type */
    private $type;

    /** @var array */
    protected $data = [];

    /** @var int */
    private $position;

    public function __construct($type, array $data = [])
    {
        $this->type = $type;

        $this->position = 0;

        foreach ($data as $item) {
            $this[] = $item;
        }
    }

    public function current()
    {
        return $this->data[$this->position];
    }

    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        $value = $this->validateType($this->type, $value);

        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->data[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function count(): int
    {
        return count($this->data);
    }
}
