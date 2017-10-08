<?php

class MagedIn_HTTPRequest_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Ways to obtain the Request Object.
     */
    public function indexAction()
    {
        /**
         * This is a global way to retrieve the HTTP Request.
         *
         * @var Mage_Core_Controller_Request_Http $request
         */
        $requestGlobal = Mage::app()->getRequest();

        /**
         * This is the way to retrieve the HTTP Request inside a controller class.
         *
         * @var Mage_Core_Controller_Request_Http $request
         */
        $requestLocal = $this->getRequest();
    }


    /**
     * Retrieve the module information from Request Object.
     */
    public function moduleInfoAction()
    {
        /** @var string $module */
        $module = $this->getRequest()->getModuleName();

        /** @var string $controller */
        $controller = $this->getRequest()->getControllerName();

        /** @var string $action */
        $action = $this->getRequest()->getActionName();

        echo "Module: $module</br>";
        echo "Controller: $controller</br>";
        echo "Action: $action</br>";
    }


    /**
     * Checks if the request is of ajax type.
     */
    public function isAjaxAction()
    {
        /** @var bool $isAjax */
        $isAjax = $this->getRequest()->isAjax();
        echo $isAjax ? 'Is an ajax request.' : 'Is not an ajax request.';
    }


    /**
     * Retrieve the current domain from Request Object.
     */
    public function domainAction()
    {
        /** @var string $domain */
        $domain = $this->getRequest()->getHttpHost();
        echo $domain;
    }


    /**
     * Retrieve the path info from Request Object.
     */
    public function pathAction()
    {
        /** @var string $path */
        $path = $this->getRequest()->getPathInfo();
        echo $path;
    }

}
