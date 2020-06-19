<?php
namespace NgocThanh\Blog\Helper\Post;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use NgocThanh\Blog\Model\ResourceModel\Reponsitory\CollectionFactory;

/**
 * Class Post
 * @package NgocThanh\Blog\Helper\Post
 */
class Post extends AbstractHelper
{
    /**
     * @var CollectionFactory
     */
    protected $_colectionFactory;

    /**
     * Post constructor.
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
     * @return \NgocThanh\Blog\Model\ResourceModel\Reponsitory\Collection
     */
    public function getListPost()
    {
        $collection = $this->_colectionFactory->create();
        return $collection;
    }


}
