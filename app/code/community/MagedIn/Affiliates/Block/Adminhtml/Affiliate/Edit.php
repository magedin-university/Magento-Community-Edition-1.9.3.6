<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    use MagedIn_Affiliates_Block_Adminhtml_Common;


    /** @var string */
    protected $_blockGroup = 'magedin_affiliates';

    /** @var string */
    protected $_controller = 'adminhtml_affiliate';


    public function __construct()
    {
        parent::__construct();

        $this->_updateButton('save',   'label', $this->__('Save Affiliate'));
        $this->_updateButton('delete', 'label', $this->__('Delete Affiliate'));
    }


    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if ($this->getAffiliateId()) {
            $affiliateName = $this->getAffiliate()->getName();
            return $this->__("Edit Affiliate '%s'", $this->escapeHtml($affiliateName));
        }

        return $this->__('New Affiliate');
    }


    /**
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('*/*/save');
    }

}
