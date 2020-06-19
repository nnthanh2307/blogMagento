<?php
namespace NgocThanh\Blog\Helper\Category;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use NgocThanh\Blog\Model\ResourceModel\Category\CollectionFactory;

/**
 * Class Category
 * @package NgocThanh\Blog\Helper\Category
 */
class Category extends AbstractHelper
{
    /**
     * @var CollectionFactory
     */
    protected $_colectionFactory;

    /**
     * Category constructor.
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
)
    {
        parent::__construct($context);
        $this->_colectionFactory = $collectionFactory;
    }

    /**
     * @return \NgocThanh\Blog\Model\ResourceModel\Category\Collection
     */
    public function getCategory()
    {
        $collection = $this->_colectionFactory->create();
        return $collection;
    }
}
