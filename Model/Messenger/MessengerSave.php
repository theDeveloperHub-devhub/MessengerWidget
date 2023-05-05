<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Model\Messenger;

use DevHub\MessengerWidget\Api\Data\MessengerInterface;
use DevHub\MessengerWidget\Api\MessengerSaveInterface;
use DevHub\MessengerWidget\Model\ResourceModel\Messenger;
use Magento\Framework\Exception\CouldNotSaveException;

class MessengerSave implements MessengerSaveInterface
{
    /**
     * @var Messenger
     */
    private $resource;

    public function __construct(Messenger $resource)
    {
        $this->resource = $resource;
    }

    public function execute(MessengerInterface $messenger): MessengerInterface
    {
        try {
            $this->resource->save($messenger);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Problems with saving messenger'), $e);
        }

        return $messenger;
    }
}
