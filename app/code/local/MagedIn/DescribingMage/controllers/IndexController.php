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


    public function directoryAction()
    {
        /**
         * Gathering Magento base directories.
         */
        $base    = (string) Mage::getBaseDir('base');
        $app     = (string) Mage::getBaseDir('app');
        $code    = (string) Mage::getBaseDir('code');
        $design  = (string) Mage::getBaseDir('design');
        $etc     = (string) Mage::getBaseDir('etc');
        $lib     = (string) Mage::getBaseDir('lib');
        $locale  = (string) Mage::getBaseDir('locale');
        $media   = (string) Mage::getBaseDir('media');
        $skin    = (string) Mage::getBaseDir('skin');
        $var     = (string) Mage::getBaseDir('var');
        $tmp     = (string) Mage::getBaseDir('tmp');
        $cache   = (string) Mage::getBaseDir('cache');
        $log     = (string) Mage::getBaseDir('log');
        $session = (string) Mage::getBaseDir('session');
        $upload  = (string) Mage::getBaseDir('upload');
        $export  = (string) Mage::getBaseDir('export');

        /**
         * Gathering modules directories.
         */
        $moduleEtc         = Mage::getModuleDir('etc', 'Mage_Core');
        $moduleControllers = Mage::getModuleDir('controllers', 'Mage_Core');
        $moduleSql         = Mage::getModuleDir('sql', 'Mage_Core');
        $moduleData        = Mage::getModuleDir('data', 'Mage_Core');
        $moduleLocaled     = Mage::getModuleDir('locale', 'Mage_Core');

        /** It does not work because it's not listed in Mage_Core_Model_Config::getModuleDir() method. */
        $moduleModel       = Mage::getModuleDir('model', 'Mage_Core');
    }


    /**
     * Playing around with URL generation.
     */
    public function generateUrlAction()
    {
        $productId  = 123;
        $categoryId = 3;

        /**
         * Default way to retrieve frontend URLs in Magento.
         *
         * @var string $url
         */
        $url = Mage::getUrl('catalog/product/view', [
            'product_id'  => $productId,
            'category_id' => $categoryId
        ]);

        /**
         * An easy way to retrieve Magento admin urls.
         *
         * @var Mage_Core_Model_Store $store
         */
        $store = Mage::app()->getStore('admin');
        $url   = $store->getUrl('adminhtml/catalog_product/edit', [
            'product_id' => $productId,
            'category_id' => $categoryId
        ]);

        /**
         * This is the main object to generate URLs in Magento.
         *
         * @var Mage_Core_Model_Url $urlModel
         */
        $urlModel = Mage::getSingleton('core/url');

        /**
         * We didn't set the Store Model to URL Model, consequently it will use the current store to generate URLs.
         *
         * @var string $urlFrontend
         */
        $urlFrontend = $urlModel->getUrl('catalog/product/view', [
            'product_id'  => $productId,
            'category_id' => $categoryId
        ]);

        /**
         * Setting the Admin Store model to URL Model so all the URLs generated after will be admin urls.
         */
        $urlModel->setStore($store);

        /** @var string $urlAdmin */
        $urlAdmin = $urlModel->getUrl('adminhtml/catalog_product/edit', [
            'product_id'  => $productId,
            'category_id' => $categoryId
        ]);
    }


    /**
     * Working with configurations.
     */
    public function getConfigAction()
    {
        /**
         * This is the default way to retrieve the Magento configurations.
         * But these configurations are under <default> node in config.xml file and in the database.
         */
        $activePath = 'magedin_describingmage/settings/active';
        $serialPath = 'magedin_describingmage/settings/serial_key';

        /** @var Mage_Core_Model_Store $store */
        $store = Mage::app()->getStore();
        $store->getConfig($activePath);
        $store->getConfig($serialPath);

        /**
         * @var bool   $isActive
         * @var string $serialKey
         */
        $isActive  = Mage::getStoreConfigFlag($activePath);
        $serialKey = Mage::getStoreConfig($serialPath);


        /**
         * Getting an unusual configuration value.
         *
         * @var Mage_Core_Model_Config $config
         */
        $config = Mage::app()->getConfig();
        $frontName = (string) $config->getNode('frontend/routers/magedin_describingmage/args/frontName');

        /**
         * Iterating configurations when needed.
         */
        $xPath     = 'frontend/events/controller_action_postdispatch_magedin_describingmage_index_registry/observers';
        $observers = $config->getNode($xPath);

        /** @var Mage_Core_Model_Config_Element $observer */
        foreach ($observers->children() as $observer) {
            $class  = (string) $observer->class;
            $method = (string) $observer->method;
        }
    }

}
