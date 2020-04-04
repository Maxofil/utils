<?php

declare(strict_types = 1);

namespace Infinityloop\Utils;

abstract class ImmutableSet implements \Iterator, \ArrayAccess, \Countable
{
    use \Nette\SmartObject;

    protected array $array = [];

    protected function __construct(array $data)
    {
        $this->array = $data;
    }

    public function current()
    {
        return \current($this->array);
    }

    public function next() : void
    {
        \next($this->array);
    }

    public function key()
    {
        return \key($this->array);
    }

    public function valid() : bool
    {
        return \key($this->array) !== null;
    }

    public function rewind() : void
    {
        \reset($this->array);
    }

    public function count() : int
    {
        return \count($this->array);
    }

    public function offsetExists($name) : bool
    {
        return \array_key_exists($name, $this->array);
    }

    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new \Exception('Item doesnt exist.');
        }

        return $this->array[$offset];
    }

    public function offsetSet($offset, $value) : void
    {
        throw new \Exception('Unsupported operation.');
    }

    public function offsetUnset($offset) : void
    {
        throw new \Exception('Unsupported operation.');
    }

    protected function appendUnique($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            throw new \Exception('Duplicated item.');
        }

        $this->array[$offset] = $value;
    }
}
