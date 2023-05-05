<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Model\Icon;

interface ResizerInterface
{
    public const BASE_IMAGE_SIZE = 60;

    public const RETINA_IMAGE_SIZE = 120;

    public const MINIMUM_UPLOAD_SIZE = 120;

    public const UPLOAD_DIR = 'messengerwidget';

    public const UPLOAD_DIR_RETINA = 'messengerwidget/retina';

    /**
     * @param string $file
     * @return void
     */
    public function execute(string $file): void;
}
