<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Model\Messenger;

use DevHub\MessengerWidget\Api\Data\MessengerInterface;
use DevHub\MessengerWidget\Api\Data\MessengerInterfaceFactory;
use DevHub\MessengerWidget\Api\MessengerGetInterface;
use DevHub\MessengerWidget\Model\ResourceModel\Messenger;
use Magento\Framework\Exception\NoSuchEntityException;

class MessengerGet implements MessengerGetInterface
{
    /**
     * @var MessengerInterfaceFactory
     */
    private $messengerFactory;

    /**
     * @var Messenger
     */
    private $messengerResource;

    public function __construct(MessengerInterfaceFactory $messengerFactory, Messenger $messengerResource)
    {
        $this->messengerFactory = $messengerFactory;
        $this->messengerResource = $messengerResource;
    }

    /**
     * @param int $messengerId
     * @return MessengerInterface
     * @throws NoSuchEntityException
     */
    public function execute(int $messengerId): MessengerInterface
    {
        $object = $this->messengerFactory->create();
        $this->messengerResource->load($object, $messengerId);

        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Messenger with id %1 does not exists', $messengerId));
        }

        return $object;
    }
}
