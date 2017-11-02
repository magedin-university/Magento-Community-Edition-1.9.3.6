<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /** @var string */
    protected $_blockGroup = 'magedin_affiliates';

    /** @var string */
    protected $_controller = 'adminhtml_affiliate';


    public function __construct()
    {
        parent::__construct();

        $this->_headerText = $this->__('Affiliate Manager');
    }


    /**
     * @return string
     */
    protected function getAddButtonLabel()
    {
        return $this->__('Add New Affiliate');
    }

}
