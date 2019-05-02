<?php
/**
 * Romano van Kempen 2019
 */
namespace Sanoma\Maintenance\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\App\RequestInterface;

/**
 * index controller
 */
class Index extends \Magento\Framework\App\Action\Action
{
    
    protected $resultPageFactory;
    protected $resultForwardFactory;
    protected $helper;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        \Sanoma\Maintenance\Helper\Data $helper
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->helper = $helper;
        parent::__construct($context);
    }

    public function dispatch(RequestInterface $request)
    {
        if (!$this->helper->isEnabled()) {
            throw new NotFoundException(__('Page not found.'));
        }
        return parent::dispatch($request);
    }
    
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Sanoma Maintenance Page'));
        if (!$resultPage) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        return $resultPage;
    }
} 