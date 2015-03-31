<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mariusz
 * Date: 14.02.15
 * Time: 16:06
 * To change this template use File | Settings | File Templates.
 */

namespace Auth\Form;

use Zend\Form\Form;

class AuthForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('album');

        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'email',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'attributes' => array(
                'id' => 'pwd',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}