<?php
/**
 * Romano van Kempen 2019
 */
namespace Sanoma\Maintenance\Cron;

use Magento\Framework\App\Cache\Manager;
use Magento\Framework\Event\ManagerInterface;
use \Magento\Framework\Stdlib\DateTime\DateTime;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\App\Config\Storage\WriterInterface;
use \Psr\Log\LoggerInterface;
use \Sanoma\Maintenance\Helper\Data;

/**
 * cron schedule execute
 */
class Schedule extends Template {

  protected $logger;

  public function __construct(
          
    LoggerInterface $logger, Context $context, 
    StoreManagerInterface $storeManager, 
    Data $helperData,
    DateTime $date, 
    WriterInterface $writer,
    Manager $cacheManager,
    ManagerInterface $eventManager) {

    $this->logger = $logger;
    $this->_storeManager = $storeManager;
    $this->_helperData = $helperData;
    $this->date = $date;
    $this->writer = $writer;
    $this->cacheManager = $cacheManager;
    $this->eventManager = $eventManager;
    parent::__construct($context);
  }

  public function execute() {
    
    $schedule_config = $this->_helperData->getValuesScheduleEnabled();
    
    if($schedule_config == 0) {

       exit();
    }
    
    $schedule_stop_time = $this->_helperData->getValuesScheduleDate();
    $schedule_stop_timestamp = strtotime($schedule_stop_time);
    $timestamp_current_utc_date = $this->date->gmtTimestamp();
    $timestamp_current_date = $timestamp_current_utc_date + 7200;
    $cacheTypes = array('config');
        
    if($schedule_stop_timestamp < $timestamp_current_date) {
       
       $this->writer->save('sanoma/basic/enabled', 0);
       $this->eventManager->dispatch('adminhtml_cache_flush_all');
       $this->cacheManager->flush($cacheTypes);
    }
  }
}