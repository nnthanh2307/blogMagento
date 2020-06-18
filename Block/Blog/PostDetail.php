<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Post\Post;
use NgocThanh\Blog\Model\ResourceModel\RelatedProduct\CollectionFactory;

class PostDetail extends \Magento\Framework\View\Element\Template
{
    protected $_post;
    protected $_relatedProduct;

    public function __construct(
        array $data = [],
        Template\Context $context,
        Post $post,
        CollectionFactory $collectionFactory
    ) {
        $this->_relatedProduct = $collectionFactory;
        $this->_post = $post;
        parent::__construct($context, $data);
    }

    public function getRelatedProduct()
    {
        $listProduct = $this->_relatedProduct->create()->addFieldToFilter("post_id",["eq" => $this->getRequest()->getParam("id")]);
        return $listProduct;
    }

    public function getPost()
    {
        $listPost = $this->_post->getListPost();
        $post = [];
        if (!empty($this->getRequest()->getParam("id"))) {
            foreach ($listPost as $item) {
                if ($this->getRequest()->getParam("id") == $item->getData()["post_id"]) {
                    $post[] = $item->getData();
                }
            }
        }
        return $post;
    }
}
