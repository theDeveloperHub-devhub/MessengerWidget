<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Controller\Adminhtml\Messenger;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Forward;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

class NewAction extends Action implements HttpGetActionInterface
{
    /**
     * @var ForwardFactory
     */
    private $resultForwardFactory;

    public function __construct(Context $context, ForwardFactory $resultForwardFactory)
    {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
    }

    /**
     * @return Forward
     */
    public function execute()
    {
        return $this->resultForwardFactory->create()->forward('edit');
    }
}
