<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    private $_objectManager;
    public function indexAction()
    {

        //https://samsonasik.wordpress.com/2013/04/10/zend-framework-2-generate-doctrine-entities-from-existing-database-using-doctrinemodule-and-doctrineormmodule/
        //https://github.com/stevenalexander/zf2-example-doctrine2
        //http://marco-pivetta.com/doctrine-orm-zf2-tutorial/#/




        //http://wildlyinaccurate.com/useful-doctrine-2-console-commands/
        return new ViewModel();
    }


    public function testAction(){
        $albums = $this->getObjectManager()->getRepository('\Application\Entity\Album')->findAll();
        return new ViewModel(array('albums' => $albums));
    }

    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->_objectManager;
    }
}
