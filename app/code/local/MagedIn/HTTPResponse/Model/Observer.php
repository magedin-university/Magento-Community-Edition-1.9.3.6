<?php

class MagedIn_HTTPResponse_Model_Observer
{

    /**
     * Forces the redirect before the controller action be dispatched.
     *
     * @param Varien_Event_Observer $observer
     */
    public function forceRedirect(Varien_Event_Observer $observer)
    {
        /** @var Mage_Core_Controller_Response_Http $response */
        $response = Mage::app()->getResponse();

        /** @var string $url */
        $url = Mage::getUrl('*/*/index');
        $response->setRedirect($url);
        $response->sendResponse();

        die();
    }

}
