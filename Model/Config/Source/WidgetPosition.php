<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class WidgetPosition implements OptionSourceInterface
{
    public const BOTTOM_RIGHT = 'bottom-right';
    public const BOTTOM_LEFT = 'bottom-left';
    public const MIDDLE_RIGHT = 'center-right';
    public const MIDDLE_LEFT = 'center-left';
    public const TOP_RIGHT = 'top-right';
    public const TOP_LEFT = 'top-left';

    /**
     * @return array[]
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => self::BOTTOM_RIGHT, 'label' => __('Bottom right')],
            ['value' => self::BOTTOM_LEFT, 'label' => __('Bottom left')],
            ['value' => self::MIDDLE_RIGHT, 'label' => __('Middle right')],
            ['value' => self::MIDDLE_LEFT, 'label' => __('Middle left')],
            ['value' => self::TOP_RIGHT, 'label' => __('Top right')],
            ['value' => self::TOP_LEFT, 'label' => __('Top left')],
        ];
    }
}
