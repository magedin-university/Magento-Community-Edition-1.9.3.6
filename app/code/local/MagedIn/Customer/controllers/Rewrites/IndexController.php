<?php

class MagedIn_Customer_Rewrites_IndexController extends Mage_Core_Controller_Front_Action
{

    public function controllerRewriteAction()
    {
        echo $this->__('This is an override using the after option.');
    }

}
