<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Controller\Adminhtml\Messenger;

use DevHub\MessengerWidget\Api\MessengerGetInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action implements HttpGetActionInterface
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

    /**
     * @var MessengerGetInterface
     */
    private $messengerGet;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MessengerGetInterface $messengerGet
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->messengerGet = $messengerGet;
    }

    /**
     * @return Page|Redirect
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('messenger_id');

        if ($id) {
            try {
                $this->messengerGet->execute($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath('*/*/');

                return $resultRedirect;
            }
        }

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        // @TODO: change breadcrumbs
        $resultPage->setActiveMenu('DevHub_MessengerWidget::messenger_manage')
            ->addBreadcrumb(__('Content'), __('Content'))
            ->addBreadcrumb(__('Messengers'), __('Messengers'));
        $resultPage->getConfig()->getTitle()->prepend(
            $id ? __('Edit Messenger') : __('New Messenger')
        );

        return $resultPage;
    }
}
