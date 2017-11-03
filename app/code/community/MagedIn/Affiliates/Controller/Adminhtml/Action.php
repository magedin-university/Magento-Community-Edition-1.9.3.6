<?php

abstract class MagedIn_Affiliates_Controller_Adminhtml_Action extends Mage_Adminhtml_Controller_Action
{

    const KEY_AFFILIATE_NEW   = 'affiliate_new';
    const AFFILIATE_MODEL_KEY = 'current_affiliate';


    protected $_affiliateFields = [
        'id',
        'name',
        'description',
        'comment',
        'sales_commission_type',
        'sales_commission_percent',
        'sales_commission_fixed',
        'created_at',
        'updated_at',
    ];


    /**
     * @param null|bool $flag
     *
     * @return $this|bool
     */
    protected function _isAffiliateNew($flag = null)
    {
        if (is_null($flag) || !is_bool($flag)) {
            return (bool) Mage::registry(self::KEY_AFFILIATE_NEW);
        }

        Mage::register(self::KEY_AFFILIATE_NEW, (bool) $flag, true);

        return $this;
    }


    /**
     * @param null|string|array $ids
     * @param bool              $generateBlocks
     * @param bool              $generateXml
     *
     * @return $this
     */
    protected function _initLayout($ids = null, $generateBlocks = true, $generateXml = true)
    {
        $this->loadLayout($ids, $generateBlocks, $generateXml);
        $this->_title($this->__('MagedIn'))
             ->_title('Affiliates');

        return $this;
    }


    /**
     * @return Mage_Adminhtml_Model_Session
     */
    protected function _getAdminhtmlSession()
    {
        return Mage::getSingleton('adminhtml/session');
    }


    /**
     * @param null|int $id
     * @param array    $data
     *
     * @return MagedIn_Affiliates_Model_Affiliate
     */
    protected function _getAffiliateModel($id = null, array $data = [])
    {
        /** @var MagedIn_Affiliates_Model_Affiliate $affiliate */
        $affiliate = Mage::getModel('magedin_affiliates/affiliate');

        if (!empty($id)) {
            $affiliate->load((int) $id);
        }

        if (!empty($data)) {
            $affiliate->addData($data);
        }

        Mage::register(self::AFFILIATE_MODEL_KEY, $affiliate, true);

        return $affiliate;
    }


    /**
     * @param array $affiliateData
     *
     * @return array
     */
    protected function _filterAffiliateData(array $affiliateData = [])
    {
        foreach ($affiliateData as $index => $value) {
            if (!in_array($index, $this->_affiliateFields)) {
                unset($affiliateData[$index]);
            }
        }

        return $affiliateData;
    }


    /**
     * @return $this
     */
    protected function _grid()
    {
        $affiliateId = $this->getRequest()->getParam('id');
        $this->_getAffiliateModel($affiliateId);

        $handle = $this->getFullActionName();

        $this->loadLayout($handle);
        $this->renderLayout();

        return $this;
    }

}
