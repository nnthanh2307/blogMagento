<?php

namespace NgocThanh\Blog\Ui\Tag\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Category
 * @package NgocThanh\Blog\Ui\Category\Source
 */
class Tag implements ArrayInterface
{
    /**
     * @var \NgocThanh\Blog\Model\TagFactory
     */
    protected $_tagFactory;

    public function __construct(
        \NgocThanh\Blog\Model\TagFactory $tagFactory
    ) {
        $this->_tagFactory = $tagFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];
        $collection = $this->_tagFactory->create()->getCollection();
        foreach ($collection as $item) {
            $result[] = ["label" => $item->getTagName(),"value" => $item->getId()];
        }
        return $result;
    }
}
