<?php

namespace Product\Entity;

use Zend\EventManager;

abstract class AbstractEntity implements EventManager\EventManagerAwareInterface
{
    use EventManager\EventManagerAwareTrait;

    protected $inputFilter;

    public function __construct()
    {
        $em = $this->getEventManager();
        $em->attach('property.set', array($this, 'filter'));
        $em->attach('property.set', array($this, 'onPropertySet'));
        $em->attach('property.get', array($this, 'onPropertyGet'));
    }

    public function setInputFilter(InputFilter $filter)
    {
        $this->inputFilter = $filter;
        return $this;
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $this->setInputFilter(new InputFilter());
        }

        return $this->inputFilter;
    }

    public function set($name, $value)
    {
        $argv = compact('name', 'value');
        $argv = $this->getEventManager()->prepareArgs($argv);
        $result = $this->getEventManager()->trigger(
            'property.set',
            $this,
            $argv
        );

        return $this;
    }

    public function get($name)
    {
        $result = $this->getEventManager()->trigger(
            'property.get',
            $this,
            array('name' => $name)
        );

        return $result->last();
    }

    public function filter(Event $e)
    {
        $params = $e->getParams();
        $input = $this->getInputFilter()->get($params['name']);
        $params['value'] = $input->getFilterChain()->filter($params['value']);
        $this->getEventManager()->trigger('filter', $this, $params);

        return $params['value'];
    }

    public function onPropertySet(Event $e)
    {
        $params = $e->getParams();

        $this->{$params['name']} = $params['value'];

        return $params['value'];
    }

    public function onPropertyGet(Event $e)
    {
        $name = $e->getParam('name');

        return $this->$name;
    }
}
