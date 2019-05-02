<?php

namespace Sanoma\Maintenance\Block\Adminhtml\System\Config;
use       \Magento\Framework\Stdlib\DateTime;
use       \Magento\Framework\Data\Form\Element\AbstractElement;

class Date extends \Magento\Config\Block\System\Config\Form\Field
{
    public function render(AbstractElement $element)
    {
        $element->setDateFormat(DateTime::DATE_INTERNAL_FORMAT);
        $element->setTimeFormat('HH:mm:ss');
        $element->setShowsTime(true);
        return parent::render($element);
    }
}
