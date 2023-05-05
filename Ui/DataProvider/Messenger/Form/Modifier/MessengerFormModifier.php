<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Ui\DataProvider\Messenger\Form\Modifier;

use DevHub\MessengerWidget\Model\Icon\Uploader;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;

class MessengerFormModifier implements ModifierInterface
{
    /**
     * @var Uploader
     */
    private $uploader;

    public function __construct(
        Uploader $uploader
    ) {
        $this->uploader = $uploader;
    }

    /**
     * @param array $data
     * @return array
     */
    public function modifyData(array $data): array
    {
        foreach ($data as &$messenger) {
            if (!empty($messenger['icon'])) {
                $img[0] = $this->uploader->getFileInfo($messenger['icon']);
                $messenger['icon'] = $img;
            }
        }

        return $data;
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta): array
    {
        return $meta;
    }
}
