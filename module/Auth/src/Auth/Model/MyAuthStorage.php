<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mariusz
 * Date: 24.03.15
 * Time: 16:11
 * To change this template use File | Settings | File Templates.
 */


//module/SanAuth/src/SanAuth/Model/MyAuthStorage.php
namespace Auth\Model;

use Zend\Authentication\Storage;

class MyAuthStorage extends Storage\Session
{
    public function setRememberMe($rememberMe = 0, $time = 1209600)
    {
        if ($rememberMe == 1) {
            $this->session->getManager()->rememberMe($time);
        }
    }

    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    }
}