<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Observer\Admin\Messenger;

use DevHub\MessengerWidget\Model\Icon\Uploader;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Delete implements ObserverInterface
{
    /**
     * @var Uploader
     */
    private $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * Event name 'devhub_messenget_widget_messenger_delete_after'
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $messenger = $observer->getObject();
        if ($messenger->getIcon()) {
            $this->uploader->remove($messenger->getIcon());
        }
    }
}
