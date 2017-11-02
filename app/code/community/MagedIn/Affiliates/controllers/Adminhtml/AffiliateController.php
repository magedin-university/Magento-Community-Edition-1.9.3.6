<?php

class MagedIn_Affiliates_Adminhtml_AffiliateController extends MagedIn_Affiliates_Controller_Adminhtml_Action
{

    /**
     * Affiliates Grid.
     */
    public function indexAction()
    {
        $this->_initLayout();
        $this->_title($this->__('Affiliates Grid'));
        $this->renderLayout();
    }


    /**
     * Create New Affiliate.
     */
    public function newAction()
    {
        $this->_isAffiliateNew(true);
        $this->_forward('edit');
    }


    /**
     * Edit Affiliate.
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');

        if (!empty($id)) {
            $this->_isAffiliateNew(false);
        }

        try {
            /** @var MagedIn_Affiliates_Model_Affiliate $affiliate */
            $affiliate = $this->_getAffiliateModel($id);

            if (!$this->_isAffiliateNew() && !$affiliate->getId()) {
                Mage::throwException($this->__('This affiliate does not exist.'));
            }
        } catch (Exception $e) {
            $this->_getAdminhtmlSession()->addError($e->getMessage());
            $this->_redirect('*/*/index');

            return;
        }

        $this->_initLayout();
        $title = $this->_isAffiliateNew() ? $this->__('New Affiliate') : $this->__('Edit Affiliate');
        $this->_title($title);
        $this->renderLayout();
    }


    /**
     * Save Affiliate.
     */
    public function saveAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_getAdminhtmlSession()->addError($this->__('Invalid request type.'));
            $this->_redirect('*/*/index');

            return;
        }

        $affiliateData = (array) $this->getRequest()->getPost('affiliate', array());
        $id            = isset($affiliateData['id']) ? (int) $affiliateData['id'] : null;

        unset($affiliateData['id']);

        $affiliateData = $this->_filterAffiliateData($affiliateData);

        /** @var MagedIn_Affiliates_Model_Affiliate $affiliate */
        $affiliate = $this->_getAffiliateModel($id);

        try {
            $affiliate->addData($affiliateData);
            $affiliate->save();

            $method = empty($id) ? $this->__('created') : $this->__('updated');
            $this->_getAdminhtmlSession()->addSuccess($this->__('The affiliate was successfully %s.', $method));
        } catch (Exception $e) {
            $this->_getAdminhtmlSession()->addError($e->getMessage());

            $params = [
                '_current' => true,
            ];

            if ($affiliate->getId()) {
                $params['id'] = $affiliate->getId();
            }

            $this->_redirect('*/*/edit', $params);
        }

        $this->_redirect('*/*');
    }


    /**
     * Remove Affiliates.
     */
    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getParam('id');

            /**
             * It's not required to load the affiliate model.
             */
            $this->_getAffiliateModel(null, [
                'id' => $id]
            )->delete();


            $this->_getAdminhtmlSession()->addSuccess($this->__('The affiliate was successfully deleted.'));
        } catch (Exception $e) {
            $this->_getAdminhtmlSession()->addError($e->getMessage());
        }

        $this->_redirect('*/*/index');
    }


    /**
     * Grid Action.
     */
    public function gridAction()
    {
        $handle = $this->getFullActionName();

        $this->loadLayout($handle);
        $this->renderLayout();
    }

}
