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


    /**
     * Working with Magento Registry.
     */
    public function registryAction()
    {
        $rand   = (int) rand(1000, 9999);
        $string = (string) $this->__('This is my string with a rand value: %s.', $rand);

        /**
         * Registering some value to Magento Registry. It can be any type of value.
         */
        Mage::register('magedin_describingmage_rand_value', $rand, true);
    }

}
