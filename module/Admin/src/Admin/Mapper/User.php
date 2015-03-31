<?php

namespace Admin\Mapper;

use Admin\DataSource;
use Admin\Entity;

/**
 *
 */
class User
{

    /**
     * @var DataSource\User
     */
    protected $dataSource;

    /**
     * @param \Admin\DataSource\User $dataSource
     */
    public function setDataSource(DataSource\User $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @return Cursor
     */
    public function findAll()
    {
        return new Cursor(
            $this->dataSource->findAll(),
            new Entity\User()
        );
    }
}
