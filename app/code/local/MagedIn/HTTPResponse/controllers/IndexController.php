<?php

class MagedIn_HTTPResponse_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * This action just append some information to response object and it's printed in the response body.
     */
    public function indexAction()
    {
        $content = 'This is my content in the body response.';

        /**
         * This is the global way to retrieve the response object.
         *
         * @var Mage_Core_Controller_Response_Http $response
         */
        // $response = Mage::app()->getResponse();

        /**
         * This is the local way to retrieve the response object.
         *
         * @var Mage_Core_Controller_Response_Http $response
         */
        $response = $this->getResponse();
        $response->setBody($content);

        $additionalInfo = 'This is an additional info for the body response.';
        $response->setBody($additionalInfo, 'additional_info');
    }


    /**
     * This will redirect the request to index action in this controller.
     */
    public function redirectAction()
    {
        $url = Mage::getUrl('*/*/index');
        $this->getResponse()->setRedirect($url);
    }


    /**
     * This will not be processed because the observer method will run before it.
     * @see MagedIn_HTTPResponse_Model_Observer::forceRedirect()
     */
    public function redirectThroughObserverAction()
    {
        echo 'OK';
    }


    /**
     * Adds a custom header to response object.
     */
    public function customHeaderAction()
    {
        $this->getResponse()->setHeader('Developer-Name', 'MagedIn University');
    }

}
