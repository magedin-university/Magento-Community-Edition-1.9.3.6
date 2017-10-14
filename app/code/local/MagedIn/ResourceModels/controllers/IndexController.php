<?php

class MagedIn_ResourceModels_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Crate new CMS Page automatically.
     */
    public function createAction()
    {
        /** @var Mage_Cms_Model_Page $page */
        $page = Mage::getModel('cms/page');

        $page->setContent('This is the content.');
        $page->setContentHeading('This is the content heading.');
        $page->setIdentifier('magedin-resource-model-example');
        $page->setIsActive(1);
        $page->setTitle('This is The Page Title');

        $this->getResourceModel()
            ->deleteAndCreate($page);
    }


    /**
     * Get base resource model for the examples.
     *
     * @return MagedIn_ResourceModels_Model_Resource_Cms_Page
     */
    protected function getResourceModel()
    {
        /** @var MagedIn_ResourceModels_Model_Resource_Cms_Page $resouce */
        $resource = Mage::getResourceModel('magedin_resourcemodels/cms_page');

        return $resource;
    }

}
