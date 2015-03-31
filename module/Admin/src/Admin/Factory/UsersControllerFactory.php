<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mariusz
 * Date: 25.03.15
 * Time: 13:53
 * To change this template use File | Settings | File Templates.
 */

 namespace Admin\Factory;

 use Admin\Controller\UsersController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class UsersControllerFactory implements FactoryInterface
 {
     /**
      * Create service
      *
      * @param ServiceLocatorInterface $serviceLocator
      *
      * @return mixed
      */
     public function createService(ServiceLocatorInterface $serviceLocator)
     {
         $realServiceLocator = $serviceLocator->getServiceLocator();
         $postService        = $realServiceLocator->get('Admin\Service\User');

         return new UsersController($postService);
     }
 }