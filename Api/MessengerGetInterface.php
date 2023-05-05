<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Api;

use DevHub\MessengerWidget\Api\Data\MessengerInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface MessengerGetInterface
{
    /**
     * @param int $messengerId
     * @return MessengerInterface
     * @throws NoSuchEntityException
     */
    public function execute(int $messengerId): MessengerInterface;
}
