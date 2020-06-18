<?php
namespace NgocThanh\Blog\Helper\Category;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use NgocThanh\Blog\Model\ResourceModel\Category\CollectionFactory;

class Category extends AbstractHelper
{
    protected $_colectionFactory;
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
)
    {
        parent::__construct($context);
        $this->_colectionFactory = $collectionFactory;
    }

    public function getCategory()
    {
        $collection = $this->_colectionFactory->create();
        return $collection;
    }
}
