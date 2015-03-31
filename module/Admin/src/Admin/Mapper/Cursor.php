<?php

namespace Admin\Mapper;

use Iterator;
use Admin\Entity\AbstractEntity;
use Zend\Stdlib\Hydrator\ClassMethods;

class Cursor implements Iterator
{
    protected $data;
    protected $entity;
    protected $position;
    protected $hydrator;

    public function __construct($data, AbstractEntity $entity)
    {
        $this->data   = $data;
        $this->entity = $entity;
        $this->hydrator = new ClassMethods();
    }

    public function rewind()
    {
        if ($this->data instanceof Traversable) {
            $this->data->rewind();
        }
        $this->position = 0;
    }

    public function count()
    {
        if (is_array($this->data)) {
            return count($this->data);
        }

        return iterator_count($this->data);
    }

    public function current()
    {
        if ($this->data instanceof Traversable) {
            $record = $this->data->current();
        } else {
            $record = $this->data[$this->position];
        }

        $this->hydrator->hydrate($record, $this->entity);


        return $this->entity;
    }

    public function key()
    {
        if ($this->data instanceof Traversable) {
            return $this->data->key();
        }

        return $this->position;
    }

    public function next()
    {
        if ($this->data instanceof Traversable) {
            return $this->data->next();
        }
        ++$this->position;
    }

    public function valid()
    {
        if ($this->data instanceof Traversable) {
            return $this->data->valid();
        }

        return isset($this->data[$this->position]);
    }
}
