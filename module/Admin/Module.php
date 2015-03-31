<?php

namespace Admin;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module  implements AutoloaderProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }


    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Admin\Service\User' => function ($sm) {
                    $productService = new Service\User();
                    $productService->setMapper(
                        $sm->get('Admin\Mapper\User')
                    );

                  /*  $productService->getEventManager()->attach('create.post', function ($e) use ($sm) {
                        $product = $e->getParam('entity');

                        //$priceService = $sm->get('Application\Service\Price');
                        //$priceService->createPrice($product);
                    });*/

                    return $productService;
                },
                'Admin\Mapper\User' => function ($sm) {
                    $productMapper = new Mapper\User();
                    $productMapper->setDataSource(
                        $sm->get('Admin\DataSource\User')
                    );
                    return $productMapper;
                },
                'Admin\DataSource\User' => function ($sm) {
                    $dataSource = new DataSource\User();
                    $dataSource->setTableGateway(
                        new \Zend\Db\TableGateway\TableGateway('users', $sm->get('Zend\Db\Adapter\Adapter'))
                    );
                    return $dataSource;
                }
            ),
        );
    }
}
