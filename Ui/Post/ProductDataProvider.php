<?php

namespace NgocThanh\Blog\Ui\Post;

use Magento\Catalog\Model\ResourceModel\Product\Collection;

/**
 * Class ProductDataProvider
 * @package NgocThanh\Blog\Ui\Post
 * data for Related Product
 */
class ProductDataProvider extends \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider
{
    /**
     * @return Collection|\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getCollection()
    {
        /** @var Collection $collection */
        $collection = parent::getCollection();
        return $collection->addAttributeToSelect('status');
    }
}
