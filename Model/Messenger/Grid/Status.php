<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Model\Messenger\Grid;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    public const INACTIVE = 0;
    public const ACTIVE = 1;

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => ' ', 'label' => ' '],
            ['value' => self::INACTIVE, 'label' => __('Inactive')],
            ['value' => self::ACTIVE, 'label' => __('Active')],
        ];
    }
}
