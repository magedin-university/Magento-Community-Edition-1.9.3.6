<?php

class MagedIn_CustomModel_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Used to create a new cms page.
     */
    public function createAction()
    {
        /** @var Mage_Cms_Model_Page $page */
        $page = Mage::getModel('cms/page');

        $data = [
            'title'         => 'About MagedIn University',
            'root_template' => 'two_columns_right',
            'identifier'    => 'about-magedin-university',
            'content'       => 'This is the content of my new page.',
            'is_active'     => 1,
        ];

        $page->setData($data);
        $page->save();
    }


    /**
     * How to delete entities from database.
     */
    public function indexAction()
    {
        /** @var Mage_Cms_Model_Page $page */
        $page   = Mage::getModel('cms/page');
        $pageId = 10;

        /**
         * First and simplest way.
         * This can be the heaviest way because of the loading time.
         * Basically we need to execute two operations: READ and DELETE from database.
         */
        $page->load($pageId);
        $page->delete();

        /**
         * Second way to delete from database. Magento normally uses this way to delete entities from database.
         * It's a heavy way too because it relies on the load() method to have the object.
         */
        $page->load($pageId);
        $page->isDeleted(true);
        $page->save();

        /**
         * A light-weight version of the first example.
         * Here we don't have the load() method called, so we use just one operation: DELETE.
         */
        $page->setId($pageId);
        $page->delete();

        /**
         * A light-weight version of the second example.
         * Here we don't have the load() method called, so we use just one operation: DELETE (called after the save()).
         */
        $page->setId($pageId);
        $page->isDeleted(true);
        $page->save();
    }


    /**
     * Using resource models example.
     */
    public function resourcesAction()
    {
        /** @var Mage_Cms_Model_Page $page */
        $page = Mage::getModel('cms/page');
        $page->load(3);

        /** @var Mage_Cms_Model_Resource_Page $resource */
        $resource = $page->getResource();
        $title    = $resource->getCmsPageTitleById(3);
    }


    /**
     * Using resource collections example.
     */
    public function collectionsAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = Mage::getResourceModel('cms/page_collection');
        $collection->load();

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $title = $page->getTitle();
        }
    }


    /**
     * Export examples action.
     */
    public function exportAction()
    {
        /** @var Mage_Cms_Model_Page $page */
        $page = Mage::getModel('cms/page');
        $page->load(3);

        $attributes = [
            'title', 'content', 'creation_time', 'identified', 'is_active', 'page_id', 'root_template', 'sort_order'
        ];

        /**
         * Export to array.
         *
         * @var array $array
         */
        $array  = $page->toArray($attributes);

        /**
         * Export to json format.
         *
         * @var string $json
         */
        $json   = $page->toJson($attributes);

        /**
         * Export to XML format.
         *
         * @var string $xml
         */
        $xml    = $page->toXml($attributes);

        /**
         * Export to string.
         *
         * @var string $string
         */
        $string = $page->toString();

        /**
         * Export object data for logging purposes.
         *
         * @var array $debug
         */
        $debug  = $page->debug();
    }

}
