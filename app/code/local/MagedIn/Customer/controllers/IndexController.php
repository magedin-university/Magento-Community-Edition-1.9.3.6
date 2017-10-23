<?php

class MagedIn_Customer_IndexController extends Mage_Core_Controller_Front_Action
{

    public function modelRewriteAction()
    {
        /** @var MagedIn_Customer_Model_Customer_Customer $customer */
        $customer = Mage::getModel('customer/customer');

        $customer->defineAge(30);
        $age = $customer->retrieveAge();

        $customer->setFirstname('Tiago');
        // $customer->setNickname();
        $nickname = $customer->getNickname();
    }

}
