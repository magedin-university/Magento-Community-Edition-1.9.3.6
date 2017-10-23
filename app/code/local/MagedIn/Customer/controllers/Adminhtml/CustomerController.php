<?php

require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'CustomerController.php';

class MagedIn_Customer_Adminhtml_CustomerController extends Mage_Adminhtml_CustomerController
{

    public function specialAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

}
