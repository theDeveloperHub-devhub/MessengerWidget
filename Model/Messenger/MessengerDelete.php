<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Model\Messenger;

use DevHub\MessengerWidget\Api\Data\MessengerInterface;
use DevHub\MessengerWidget\Api\MessengerDeleteInterface;
use DevHub\MessengerWidget\Model\ResourceModel\Messenger;
use Magento\Framework\Exception\CouldNotDeleteException;

class MessengerDelete implements MessengerDeleteInterface
{
    /**
     * @var Messenger
     */
    private $resource;

    public function __construct(Messenger $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param MessengerInterface $messenger
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function execute(MessengerInterface $messenger): bool
    {
        try {
            $this->resource->delete($messenger);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}
