<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Controller\Adminhtml\Messenger;

use DevHub\MessengerWidget\Api\MessengerDeleteInterface;
use DevHub\MessengerWidget\Api\MessengerGetInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'DevHub_MessengerWidget::messenger_manage';

    /**
     * @var MessengerGetInterface
     */
    private $messengerGet;

    /**
     * @var MessengerDeleteInterface
     */
    private $messengerDelete;

    public function __construct(
        Context $context,
        MessengerGetInterface $messengerGet,
        MessengerDeleteInterface $messengerDelete
    ) {
        parent::__construct($context);
        $this->messengerGet = $messengerGet;
        $this->messengerDelete = $messengerDelete;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $messengerId = (int)$this->getRequest()->getParam('messenger_id');

        if (!$messengerId) {
            $this->messageManager->addErrorMessage(__('We can\'t find messenger to delete.'));

            return $resultRedirect->setPath('*/*/');
        }

        try {
            $model = $this->messengerGet->execute($messengerId);
            $this->messengerDelete->execute($model);

            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return $resultRedirect->setPath('*/*/edit', ['messenger_id' => $messengerId]);
        }
    }
}
