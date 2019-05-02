<?php
/**
 * Romano van Kempen 2019
 */
namespace Sanoma\Maintenance\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Sanoma Maintenance Page block
 */
class Maintenance extends Template
{
    
    const XML_PATH_SANOMA_MORE = 'sanoma/more/';
    const XML_PATH_SANOMA_BASIC = 'sanoma/basic/';
    
    public function __construct(Context $context, StoreManagerInterface $storeManager, ScopeConfigInterface $scopeConfig)
    {
        
        $this->_storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
        
    public function getBasic($field)
    {
        
        return $this->scopeConfig->getValue(self::XML_PATH_SANOMA_BASIC . $field, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
    public function getContent($field)
    {

        return $this->scopeConfig->getValue(self::XML_PATH_SANOMA_MORE . $field, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}  