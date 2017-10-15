<?php

class MagedIn_RsourceCollections_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Filtering collections in a simple way.
     */
    public function indexAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = $this->getCollection();
        /**
         * Possibilities:
         *
         * - is      : Is
         * - finset  : Finset
         * - eq      : Equal
         * - neq     : Not Equal
         * - like    : Like
         * - nlike   : Not Like
         * - in      : In
         * - nin     : Not In
         * - null    : Is Null
         * - notnull : Not Is Null
         * - lt      : Less Than
         * - lteq    : Less Than or Equal
         * - gt      : Greater Than
         * - gteq    : Greater Than or Equal
         */
        $collection->addFieldToFilter('root_template', ['notnull' => true]);

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $title = $page->getTitle();
        }
    }


    /**
     * Counting rows in the collection in a more performatic way.
     */
    public function countAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = $this->getCollection();

        /**
         * You can use the $collection->count() as well in some cases.
         */
        if (!$collection->getSize()) {
            return;
        }

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $title = $page->getTitle();
        }
    }


    /**
     * Saving a bunch of objects in one only call.
     */
    public function saveAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = $this->getCollection();

        if (!$collection->getSize()) {
            return;
        }

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $metaKeyWords = $page->getMetaKeywords();
            $separator    = null;

            if ($metaKeyWords) {
                $separator = ', ';
            }

            $page->setMetaKeywords($metaKeyWords . $separator . 'cms, page');
        }

        $collection->save();
    }


    /**
     * Paginating a collection is essential in some cases.
     */
    public function pageAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = $this->getCollection();

        if (!$collection->getSize()) {
            return;
        }

        $collection->setPageSize(2);
        $collection->setCurPage(3);

        $lastPageNumber = $collection->getLastPageNumber();

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $title = $page->getTitle();
        }
    }


    /**
     * Clearing the collection for reuse purposes.
     */
    public function clearAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = $this->getCollection();

        if (!$collection->getSize()) {
            return;
        }

        $collection->setPageSize(3);
        $collection->setCurPage(1);

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $title = $page->getTitle();
        }

        $collection->clear();
        $collection->setCurPage(2);

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $title = $page->getTitle();
        }

        $collection->clear();
        $collection->setCurPage(3);

        /** @var Mage_Cms_Model_Page $page */
        foreach ($collection as $page) {
            $title = $page->getTitle();
        }
    }


    /**
     * Getting the first and last items from a collection.
     */
    public function firstAndLastAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = $this->getCollection();

        if (!$collection->getSize()) {
            return;
        }

        /**
         * @var Mage_Cms_Model_Page $firstItem
         * @var Mage_Cms_Model_Page $lastItem
         */
        $firstItem = $collection->getFirstItem();
        $lastItem  = $collection->getLastItem();
    }


    /**
     * An example of how you can work with huge collections in Magento.
     */
    public function walkAction()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = $this->getCollection();

        /** @var Mage_Core_Model_Resource_Iterator $iterator */
        $iterator = Mage::getResourceModel('core/iterator');
        $iterator->walk($collection->getSelect(), array(array($this, 'preparePage')));
    }


    /**
     * Used to treat every registry in the database passed via parameter $args from $iterator (method above).
     *
     * @param array $args
     */
    public function preparePage($args = array())
    {
        /** @var array $row */
        $row = (array) $args['row'];
        echo $row['title'] . '<br/>';
    }


    /**
     * @return Mage_Cms_Model_Resource_Page_Collection
     */
    protected function getCollection()
    {
        /** @var Mage_Cms_Model_Resource_Page_Collection $collection */
        $collection = Mage::getResourceModel('cms/page_collection');

        /**
         * This is another way to get the collection from CMS Page.
         *
         * @var Mage_Cms_Model_Page                     $cms
         * @var Mage_Cms_Model_Resource_Page_Collection $collection
         *
        $cms = Mage::getModel('cms/page');
        $collection = $cms->getCollection();
        */

        return $collection;
    }

}
