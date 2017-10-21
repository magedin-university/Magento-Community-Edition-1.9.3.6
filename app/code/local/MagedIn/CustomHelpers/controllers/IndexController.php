<?php

class MagedIn_CustomHelpers_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Retrieving helper instances.
     */
    public function indexAction()
    {
        /** @var MagedIn_CustomHelpers_Helper_Data $helperData */
        $helperData = Mage::helper('magedin_customhelpers');

        /** @var MagedIn_CustomHelpers_Helper_Custom $helperCustom */
        $helperCustom = Mage::helper('magedin_customhelpers/custom');
    }


    /**
     * General methods that helps us a lot in the day-by-day.
     */
    public function generalAction()
    {
        $randomString = $this->helper()->getRandomString(50);

        $name = 'João Maranhão Gonçalves';
        $name = $this->helper()->removeAccents($name);

        $string = 'Tiago & MagedIn that <3 Magento!';
        $string = $this->helper()->escapeHtml($string);

        $url = 'http://dev.cursomagedin.com/customHelpers/index/general/?code="javascript:alert(\'Tiago Sampaio\')"';
        $url = $this->helper()->escapeUrl($url);
    }


    /**
     * Formatting and converting currencies.
     */
    public function formatCurrencyAction()
    {
        $number = (float) 7888.99;

        $currencyResult1 = $this->helper()->formatCurrency($number, false);
        $currencyResult2 = $this->helper()->currency($number, true, false);

        $price = $this->helper()->formatPrice($number, false);

        /** BRL & USD */
        $store = Mage::app()->getStore('english');

        $currencyBRL = $this->helper()->currencyByStore($number, null, true, false);
        $currencyUSD = $this->helper()->currencyByStore($number, $store, true, false);
    }


    /**
     * Formatting date.
     */
    public function formatDateAction()
    {
        $date = now();

        $full   = $this->helper()->formatDate($date, Mage_Core_Model_Locale::FORMAT_TYPE_FULL, true);
        $long   = $this->helper()->formatDate($date, Mage_Core_Model_Locale::FORMAT_TYPE_LONG, true);
        $medium = $this->helper()->formatDate($date, Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM, true);
        $short  = $this->helper()->formatDate($date, Mage_Core_Model_Locale::FORMAT_TYPE_SHORT, true);
    }


    /**
     * Formatting time.
     */
    public function formatTimeAction()
    {
        $time = now();

        $full   = $this->helper()->formatTime($time, Mage_Core_Model_Locale::FORMAT_TYPE_FULL, false);
        $long   = $this->helper()->formatTime($time, Mage_Core_Model_Locale::FORMAT_TYPE_LONG, false);
        $medium = $this->helper()->formatTime($time, Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM, false);
        $short  = $this->helper()->formatTime($time, Mage_Core_Model_Locale::FORMAT_TYPE_SHORT, false);
    }


    /**
     * Translations.
     */
    public function translateAction()
    {
        $firstname = 'Tiago';
        $lastname  = 'Sampaio';
        $product   = 'Magento';

        $translated = $this->helper()->__('My name is %s %s and I love %s!', $firstname, $lastname, $product);
    }


    /**
     * XML convert methods.
     */
    public function convertAction()
    {
        $data = [
            'name'     => 'Tiago',
            'lastname' => 'Sampaio',
            'age'      => '30',
            'gender'   => 'Male'
        ];

        /** @var SimpleXMLElement $xml */
        $xml = $this->helper()->assocToXml($data, 'person');

        /** @var string $xmlString */
        $xmlString = $xml->asXML();

        /** @var SimpleXMLElement $object */
        $object = new SimpleXMLElement($xmlString);

        /** @var array $array */
        $array = $this->helper()->xmlToAssoc($object);
    }


    /**
     * Encrypt and Decrypt methods.
     */
    public function cryptAction()
    {
        $cardNumber = '4111-1111-1111-1111';

        $encrypted = $this->helper()->encrypt($cardNumber);
        $decrypted = $this->helper()->decrypt($encrypted);
    }


    /**
     * @return MagedIn_CustomHelpers_Helper_Data
     */
    protected function helper()
    {
        /** @var MagedIn_CustomHelpers_Helper_Data $helper */
        $helper = Mage::helper('magedin_customhelpers');
        return $helper;
    }

}
