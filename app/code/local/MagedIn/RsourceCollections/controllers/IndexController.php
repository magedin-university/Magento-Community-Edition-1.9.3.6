<?php

class MagedIn_RsourceCollections_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = $this->getCollection();
        $collection->addFieldToFilter('root_template', ['notnull' => true]);

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $title = $page->getTitle();
        }
    }


    /**
     * @return Mage_Cms_Model_Resource_Page_Collection
     */
    protected function getCollection()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = Mage::getResourceModel('cms/page_collection');

        /**
         * @var Mage_Cms_Model_Page                     $cms
         * @var Mage_Cms_Model_Resource_Page_Collection $collection
         */

        /*
        $cms = Mage::getModel('cms/page');
        $collection = $cms->getCollection();
        */

        return $collection;
    }

}
