<?php
namespace NgocThanh\Blog\Helper\Post;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use NgocThanh\Blog\Model\ResourceModel\Reponsitory\CollectionFactory;

class Post extends AbstractHelper
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

    public function getListPost()
    {
        $collection = $this->_colectionFactory->create();
        return $collection;
    }


}
