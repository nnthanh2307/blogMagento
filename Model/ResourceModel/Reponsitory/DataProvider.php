<?php

namespace NgocThanh\Blog\Model\ResourceModel\Reponsitory;

/**
 * Class DataProvider
 * @package NgocThanh\Blog\Model\ResourceModel\Reponsitory
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \NgocThanh\Blog\Model\ResourceModel\Reponsitory\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $thumbnail[0]["url"] = $item->getThumbnail();
            $this->loadedData[$item->getId()] = $item->getData();
            $this->loadedData[$item->getId()]["thumbnail"] = $thumbnail;
        }
        return $this->loadedData;
    }
}
