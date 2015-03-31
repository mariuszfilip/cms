<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Auth\Form\AuthForm;

/**
 *
 */
class IndexController extends AbstractActionController
{

    /**
     * @var null
     */
    protected $form = null;

    /**
     * @var
     */
    protected $storage;
    /**
     * @var
     */
    protected $authservice;

    /**
     * @return array|object
     */
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                ->get('AuthService');
        }

        return $this->authservice;
    }


    /**
     * @return \Auth\Form\AuthForm|null
     */
    public function getForm(){
        if(is_null($this->form)){
            $oForm = new AuthForm();
            $this->form = $oForm;
        }

        return $this->form;

    }


    /**
     * @return array|\Zend\Http\Response
     */
    public function indexAction(){

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $this->getForm()->setData($data);

            if($this->getForm()->isValid()){

                $this->getAuthService()->getAdapter()
                    ->setIdentity($request->getPost('email'))
                    ->setCredential($request->getPost('password'));

                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                {
                    //save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }

                if ($result->isValid()) {
                    $redirect = 'success';
                    //check if it has rememberMe :
                    if ($request->getPost('rememberme') == 1 ) {
                        $this->getSessionStorage()
                            ->setRememberMe(1);
                        //set storage again
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->getStorage()->write($request->getPost('email'));

                    return $this->redirect()->toRoute('success');
                }

            }else{
                $errors = $this->getForm()->getMessages();

                $this->flashmessenger()->addMessage($errors);
            }



        }
        return array(
            'form' => $this->getForm(),
            'messages'  => $this->flashmessenger()->getMessages()
        );
    }

    /**
     * @return \Zend\Http\Response
     */
    public function logoutAction()
    {
       // $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();

        $this->flashmessenger()->addMessage("You've been logged out");
        return $this->redirect()->toRoute('auth');
    }

    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                ->get('MyAuthStorage');
        }

        return $this->storage;
    }



}
