<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mariusz
 * Date: 14.02.15
 * Time: 12:33
 * To change this template use File | Settings | File Templates.
 */

namespace Auth\Model;

class User{

    protected $properties = array(
        'email',
        'password',
    );



    public function getName()
    {
        return $this->get('name');
    }

    public function setName($name)
    {
        return $this->set('name', $name);
    }

}