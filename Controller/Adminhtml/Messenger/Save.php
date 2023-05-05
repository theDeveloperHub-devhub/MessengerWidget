<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Controller\Adminhtml\Messenger;

use DevHub\MessengerWidget\Api\Data\MessengerInterfaceFactory;
use DevHub\MessengerWidget\Api\MessengerGetInterface;
use DevHub\MessengerWidget\Api\MessengerSaveInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'DevHub_MessengerWidget::messenger_manage';

    /**
     * @var MessengerInterfaceFactory
     */
    private $messengerFactory;

    /**
     * @var MessengerGetInterface
     */
    private $messengerGet;

    /**
     * @var MessengerSaveInterface
     */
    private $messengerSave;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    public function __construct(
        Context $context,
        MessengerInterfaceFactory $messengerFactory,
        MessengerGetInterface $messengerGet,
        MessengerSaveInterface $messengerSave,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
        $this->messengerFactory = $messengerFactory;
        $this->messengerGet = $messengerGet;
        $this->messengerSave = $messengerSave;
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $messngerId = $this->getRequest()->getParam('messenger_id');

            if ($messngerId) {
                try {
                    $model = $this->messengerGet->execute((int)$messngerId);
                } catch (NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());

                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                unset($data['messenger_id']);
                $model = $this->messengerFactory->create();
            }
            if (!empty($data['icon'])) {
                $data['icon'] = $data['icon'][0]['file'];
            }
            $model->setData($data);

            try {
                $this->messengerSave->execute($model);
                $this->messageManager->addSuccessMessage(__('You saved the messenger.'));
                $this->dataPersistor->clear('messenger_widget_messenger');

                $back = $data['back'] ?? 'close';

                if ($back === 'continue') {
                    $resultRedirect->setPath('*/*/edit', ['messenger_id' => $model->getMessengerId()]);
                } else {
                    $resultRedirect->setPath('*/*/');
                }

                return $resultRedirect;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the messenger.'));
            }

            $this->dataPersistor->set('messenger_widget_messenger', $data);

            return $resultRedirect->setPath('*/*/edit', ['messenger_id' => $messngerId]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
