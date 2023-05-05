<?php

declare(strict_types=1);

namespace DevHub\MessengerWidget\Model\Messenger\Form;

use DevHub\MessengerWidget\Api\Data\MessengerInterface;
use DevHub\MessengerWidget\Model\ResourceModel\Messenger\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var array
     */
    private $loadedData;

    /**
     * @var PoolInterface|null
     */
    private $pool;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        PoolInterface $pool = null,
        DataPersistorInterface $dataPersistor,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->pool = $pool;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $this->loadedData = [];
        $items = $this->collection->getItems();
        /** @var MessengerInterface $messenger */
        foreach ($items as $messenger) {
            $messengerId = $messenger->getMessengerId();
            $data = $messenger->getData();
            $this->loadedData[$messengerId] = $data;
        }

        $data = $this->dataPersistor->get('messenger_widget_messenger');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $messengerId = $model->getMessengerId() ?: null;
            $this->loadedData[$messengerId] = $model->getData();
            $this->dataPersistor->clear('messenger_widget_messenger');
        }

        if ($this->pool) {
            foreach ($this->pool->getModifiersInstances() as $modifier) {
                $this->loadedData = $modifier->modifyData($this->loadedData);
            }
        }

        return $this->loadedData;
    }
}
