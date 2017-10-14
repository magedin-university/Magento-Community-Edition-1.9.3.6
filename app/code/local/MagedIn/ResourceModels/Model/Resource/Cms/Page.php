<?php

class MagedIn_ResourceModels_Model_Resource_Cms_Page extends Mage_Cms_Model_Resource_Page
{

    /**
     * @param Mage_Cms_Model_Page $page
     *
     * @return $this
     */
    public function deleteAndCreate(Mage_Cms_Model_Page $page)
    {
        if (!$page || !$page->getIdentifier()) {
            return $this;
        }

        /** @var Magento_Db_Adapter_Pdo_Mysql|Varien_Db_Adapter_Interface $read */
        $read = $this->_getReadAdapter();

        /** @var Varien_Db_Select $select */
        $select = $read->select()
            ->from($this->getMainTable(), 'page_id')
            ->where('identifier = ?', $page->getIdentifier())
            ->limit(1);

        $pageId = $read->fetchOne($select);

        if ($pageId) {
            $page->setId($pageId);
            $this->delete($page);
        }

        $page->setId(null);
        $this->save($page);

        return $this;
    }

}
