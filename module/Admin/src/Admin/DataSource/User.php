<?php

namespace Admin\DataSource;

use Zend\Db\TableGateway\TableGateway;

/**
 *
 */
class User
{
    /**
     * @var \Zend\Db\TableGateway\TableGateway
     */
    protected $gateway;

    /**
     * @param \Zend\Db\TableGateway\TableGateway $gateway
     */
    public function setTableGateway(TableGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->gateway->select()->toArray();
    }
}
