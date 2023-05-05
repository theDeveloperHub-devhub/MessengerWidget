<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Controller\Adminhtml\Messenger;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'DevHub_MessengerWidget::messenger_manage';

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        // @TODO: change breadcrumbs
        $resultPage->setActiveMenu('DevHub_MessengerWidget::messenger_manage')
            ->addBreadcrumb(__('Content'), __('Content'))
            ->addBreadcrumb(__('Messengers'), __('Messengers'));
        $resultPage->getConfig()->getTitle()->prepend(__('Messengers'));

        return $resultPage;
    }
}
