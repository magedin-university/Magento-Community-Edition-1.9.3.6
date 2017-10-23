<?php

trait MagedIn_Affiliates_Trait_Data
{

    /**
     * @param string|null $helperAlias
     *
     * @return Mage_Core_Helper_Data
     */
    protected function _helper($helperAlias = null)
    {
        if (empty($helperAlias)) {
            $classGroup = $this->getClassGroupName();
            return Mage::helper($classGroup);
        }

        if (false === strpos($helperAlias, '/')) {
            return $this->_helper($this->getClassGroupName() . '/' . $helperAlias);
        }

        return Mage::helper($helperAlias);
    }


    /**
     * Logs messages in a certain file.
     *
     * @param mixed  $message
     * @param string $file
     * @param int    $type
     * @param bool   $forceLog
     *
     * @return $this
     */
    public function log($message, $file = null, $type = Zend_Log::DEBUG, $forceLog = true)
    {
        if ($message instanceof Exception) {
            $message = $message->getMessage();
        }

        if (empty($file)) {
            $file = 'MagedIn_Affiliates.log';
        }

        Mage::log($message, $type, $file, $forceLog);

        return $this;
    }


    /**
     * Sends redirect for another route.
     *
     * @param string    $url
     * @param bool|null $secure
     */
    public function responseRedirect($url, $secure = null)
    {
        if (!is_bool($secure)) {
            $secure = $this->getRequest()->isSecure();
        }

        $this->getResponse()
            ->setRedirect(Mage::getUrl($url, ['_secure' => $secure]))
            ->sendResponse();

        die();
    }


    /**
     * @return Mage_Core_Controller_Request_Http
     */
    public function getRequest()
    {
        return Mage::app()->getRequest();
    }


    /**
     * @return Zend_Controller_Response_Http
     */
    public function getResponse()
    {
        return Mage::app()->getResponse();
    }


    /**
     * Retrieve the class group of the self object.
     *
     * @return string
     */
    protected function getClassGroupName()
    {
        $classGroup = strtolower($this->getClassGroup());

        if ('mage' === substr($classGroup, 0, 4)) {
            $classGroup = substr($classGroup, 5, strlen($classGroup) - 5);
        }

        return $classGroup;
    }


    /**
     * Retrieve helper module name
     *
     * @return string
     */
    protected function getClassGroup()
    {
        $className  = get_class($this);
        $classGroup = substr($className, 0, strpos($className, '_', strpos($className, '_') + 1));

        if (!class_exists($classGroup . '_Helper_Data')) {
            $classGroup = 'MagedIn_Affiliate';
        }

        return $classGroup;
    }


    /**
     * Translate
     *
     * @return string
     */
    public function __()
    {
        $args = func_get_args();
        $expr = new Mage_Core_Model_Translate_Expr(array_shift($args), $this->getClassGroup());
        array_unshift($args, $expr);

        return Mage::app()->getTranslator()->translate($args);
    }


    /**
     * @return Mage_Core_Model_Cookie
     */
    public function getCookie()
    {
        return Mage::app()->getCookie();
    }

}
