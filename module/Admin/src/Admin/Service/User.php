<?php

namespace Admin\Service;

use Admin\Mapper;

/**
 *
 */
class User
{

    /**
     * @var \Admin\Mapper\User $mapper
     */
    protected $mapper;

    /**
     * @param \Admin\Mapper\User $mapper
     */
    public function setMapper(Mapper\User $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->mapper->findAll();
    }
}
