<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Post\Post;

/**
 * Class Pagination
 * @package NgocThanh\Blog\Block\Blog
 */
class Pagination extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Post
     */
    protected $_collectionFactory;

    /**
     * Pagination constructor.
     * @param array $data
     * @param Template\Context $context
     * @param Post $post
     */
    public function __construct(
        array $data = [],
        Template\Context $context,
        Post $post
    ) {
        $this->_collectionFactory = $post;
        parent::__construct($context, $data);
    }

    /**
     * @return false|float
     */
    public function getPagination()
    {
        $numberPerPage = 4;
        if (!empty($this->getRequest()->getParam("num"))) {
            $numberPerPage = $this->getRequest()->getParam("num");
        }
        $collection = $this->_collectionFactory->getListPost();
        $totalRecord = $numPost = $collection->getSize();
        $numberPage = ceil($totalRecord / $numberPerPage);
        return $numberPage;
    }

    /**
     * @param $page
     * @return string
     */
    public function url($page)
    {
        if (!empty($this->getRequest()->getParam("num"))) {
            $num = $this->getRequest()->getParam("num");
            return $this->getUrl("*/*/*/num/$num/page/$page");
        } else {
            return $this->getUrl("*/*/*/page/$page");
        }
    }
}
