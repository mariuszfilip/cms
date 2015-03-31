<?php

namespace Admin\Entity;

class User extends AbstractEntity
{
    protected $properties = array(
        'id',
        'name',
    );

    public function getId()
    {
        return $this->get('id');
    }

    public function setId($id)
    {
        return $this->set('id', $id);
    }

    public function getName()
    {
        return $this->get('name');
    }

    public function setName($name)
    {
        return $this->set('name', $name);
    }
}
