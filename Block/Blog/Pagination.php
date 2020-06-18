<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Post\Post;

class Pagination extends \Magento\Framework\View\Element\Template
{
    protected $_collectionFactory;

    public function __construct(
        array $data = [],
        Template\Context $context,
        Post $post
    ) {
        $this->_collectionFactory = $post;
        parent::__construct($context, $data);
    }

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
