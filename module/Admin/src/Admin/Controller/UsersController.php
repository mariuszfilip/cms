<?php

namespace Admin\Controller;

use Admin\Service;
use Admin\Entity;
use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form;

class UsersController extends AbstractActionController
{
    protected $_service;

    public function __construct(Service\User $service)
    {
        $this->_service = $service;
    }

    public function listAction()
    {
        ///https://zf2.readthedocs.org/en/latest/in-depth-guide/data-binding.html#binding-objects-to-forms
        $list =  $this->_service->getList();
        return array(
            'list' => $list,
        );
    }



    public function createAction()
    {
        $request = $this->getRequest();
        $form = new Form\User();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entity = new Entity\User($form->getData());
                if ($this->_service->create($entity)) {
                    $this->flashMessenger()->addMessage('Product created');
                    return $this->redirect('/');
                }
            }
        }
        return array(
            'form' => $form,
        );
    }



}
