<?php

namespace NgocThanh\Blog\Ui\Category\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Category
 * @package NgocThanh\Blog\Ui\Category\Source
 */
class Category implements ArrayInterface
{
    /**
     * @var \NgocThanh\Blog\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * Category constructor.
     * @param \NgocThanh\Blog\Model\CategoryFactory $categoryFactory
     */
    public function __construct(
        \NgocThanh\Blog\Model\CategoryFactory $categoryFactory
    ) {
        $this->_categoryFactory = $categoryFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];
        $collection = $this->_categoryFactory->create()->getCollection();
        foreach ($collection as $item) {
            $result[] = ["label" => $item->getCategoryName(),"value" => $item->getId()];
        }
        return $result;
    }
}
