<?php

class MagedIn_Router_Controller_Router extends Mage_Core_Controller_Varien_Router_Standard
{

    public function match(Zend_Controller_Request_Http $request)
    {
        $path = trim($request->getPathInfo(), '/');

        if ($path !== 'meu-roteador') {
            return;
        }

        $request->setModuleName('router');
        $request->setControllerName('index');
        $request->setActionName('index');

        return true;
    }

}
