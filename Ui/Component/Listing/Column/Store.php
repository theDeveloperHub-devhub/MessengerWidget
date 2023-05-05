<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Ui\Component\Listing\Column;

class Store extends \Magento\Store\Ui\Component\Listing\Column\Store
{
    /**
     * Get data
     *
     * @param array $item
     * @return string
     */
    protected function prepareItem(array $item): string
    {
        if (!empty($item[$this->storeKey])) {
            $item[$this->storeKey] = explode(',', $item[$this->storeKey]);
        }

        return parent::prepareItem($item);
    }
}
