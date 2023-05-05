<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Model\ResourceModel\Messenger\Grid\Collection\DataFiller;

use DevHub\MessengerWidget\Api\Data\MessengerInterface;
use DevHub\MessengerWidget\Model\Config\Source\MessengerCode;
use DevHub\MessengerWidget\Model\ResourceModel\Collection\DataFillerInterface;
use DevHub\MessengerWidget\Model\ResourceModel\Messenger\Grid\Collection;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class MessengerName implements DataFillerInterface
{
    /**
     * @var MessengerCode
     */
    private $messengerCode;

    public function __construct(MessengerCode $messengerCode)
    {
        $this->messengerCode = $messengerCode;
    }

    /**
     * @param AbstractCollection|Collection $collection
     * @return void
     */
    public function attachData(AbstractCollection $collection): void
    {
        $labelsHash = $this->getMessengerLabelsHash();
        foreach ($collection->getItems() as $item) {

            $messengerCode = $item[MessengerInterface::CODE] ?? '';
            $messengerName = $labelsHash[$messengerCode] ?? '';
            if ($messengerCode === MessengerCode::OTHER) {
                $messengerName = $item[MessengerInterface::CUSTOM_NAME];
            }

            $item->setData('name', $messengerName);
        }
    }

    /**
     * @return string[] array(messengerKey => messengerLabel)
     */
    private function getMessengerLabelsHash(): array
    {
        $labels = [];

        foreach ($this->messengerCode->toOptionArray() as $item) {
            $labels[$item['value']] = $item['label'];
        }

        return $labels;
    }
}
