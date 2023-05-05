<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Api;

use DevHub\MessengerWidget\Api\Data\MessengerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;

interface MessengerDeleteInterface
{
    /**
     * @param MessengerInterface $messenger
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function execute(MessengerInterface $messenger): bool;
}
