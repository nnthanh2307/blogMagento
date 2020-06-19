<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Post\Post;
use NgocThanh\Blog\Model\ResourceModel\RelatedProduct\CollectionFactory;

/**
 * Class PostDetail
 * @package NgocThanh\Blog\Block\Blog
 */
class PostDetail extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Post
     */
    protected $_post;
    /**
     * @var CollectionFactory
     */
    protected $_relatedProduct;

    /**
     * PostDetail constructor.
     * @param array $data
     * @param Template\Context $context
     * @param Post $post
     * @param CollectionFactory $collectionFactory
     */
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

    /**
     * @return \NgocThanh\Blog\Model\ResourceModel\RelatedProduct\Collection
     */
    public function getRelatedProduct()
    {
        $listProduct = $this->_relatedProduct->create()->addFieldToFilter("post_id",["eq" => $this->getRequest()->getParam("id")]);
        return $listProduct;
    }

    /**
     * @return array
     */
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
