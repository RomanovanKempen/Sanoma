<?php
/**
 * Romano van Kempen 2019
 */
namespace Sanoma\Maintenance\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\Helper\Context;

/**
 * Sanoma Maintenance helper
 */
class Data extends AbstractHelper
{
    
    const XML_PATH_ENABLED = 'sanoma/basic/enabled/';
    const XML_PATH_SANOMA_SCHEDULE = 'sanoma/configurable_cron/';
    
    protected $storeManager;
    protected $objectManager;
    
   
    public function __construct(Context $context, ObjectManagerInterface $objectManager, StoreManagerInterface $storeManager)
    {
        $this->objectManager = $objectManager;
        $this->storeManager  = $storeManager;
        parent::__construct($context);
    }
     
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
            
    public function getValuesScheduleEnabled()
    {
        
        return $this->scopeConfig->getValue(self::XML_PATH_SANOMA_SCHEDULE  . 'schedule_enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    } 
           
    public function getValuesScheduleDate()
    {
        
        return $this->scopeConfig->getValue(self::XML_PATH_SANOMA_SCHEDULE  . 'schedule_date', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    
}