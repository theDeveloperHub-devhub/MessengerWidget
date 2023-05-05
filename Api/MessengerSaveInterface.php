<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Api;

use DevHub\MessengerWidget\Api\Data\MessengerInterface;
use Magento\Framework\Exception\CouldNotSaveException;

interface MessengerSaveInterface
{
    /**
     * @param MessengerInterface $messenger
     * @return MessengerInterface
     * @throws CouldNotSaveException
     */
    public function execute(
        MessengerInterface $messenger
    ): MessengerInterface;
}
