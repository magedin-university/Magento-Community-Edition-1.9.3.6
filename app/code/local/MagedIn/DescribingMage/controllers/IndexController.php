<?php

class MagedIn_DescribingMage_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Checkout how autoload works in Magento.
     *
     * @see Varien_Autoload::autoload($class);
     */
    public function indexAction()
    {
        /** @var Mage_Catalog_Model_Product $product */
        $product = Mage::getModel('catalog/product');
    }


    /**
     * Retrieving the version information.
     */
    public function versionAction()
    {
        $version     = (string) Mage::getVersion();
        $vertionInfo = (array)  Mage::getVersionInfo();
    }


    /**
     * Retrieving the edition information (Enterprise Edition or Community Edition).
     */
    public function editionAction()
    {
        $edition = (string) Mage::getEdition();
    }

}
