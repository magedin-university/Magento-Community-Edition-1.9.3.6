<?php

class MagedIn_Objects_IndexController extends Mage_Core_Controller_Front_Action
{

    public function preDispatch()
    {
        parent::preDispatch();

        $actionName     = $this->getRequest()->getActionName();
        $privateActions = ['logged', 'dashboard'];

        if (!in_array($actionName, $privateActions)) {
            return;
        }

        $isLoggedIn = (bool) Mage::getSingleton('customer/session')->isLoggedIn();

        if (!$isLoggedIn) {
             echo $this->__('You are not allowed to use this method until you get logged in.');
             die();
        }
    }


    public function postDispatch()
    {
        parent::postDispatch();

        echo 'This was the postDispatch method in my controller.';
    }


    public function indexAction()
    {
        $value = $this->__('String to be translated.');

        echo $value;
    }


    public function loggedAction()
    {
        echo $this->__('Welcome to our store.');
    }


    public function dashboardAction()
    {
        echo $this->__('Welcome to your dashboard.');
    }

}
