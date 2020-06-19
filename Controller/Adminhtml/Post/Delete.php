<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use NgocThanh\Blog\Model\PostFactory;
use NgocThanh\Blog\Model\ResourceModel\RelatedProduct\CollectionFactory;
use NgocThanh\Blog\Helper\Cache\CleanCache;

class Delete extends \Magento\Backend\App\Action
{
    protected $_postFactory;
    protected $_pageFactory;
    protected $_relatedProduct;
    protected $_cleanCache;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        PostFactory $postFactory,
        CleanCache $cleanCache,
        CollectionFactory $relatedProductCollection
    ) {
        $this->_relatedProduct = $relatedProductCollection;
        $this->_postFactory = $postFactory;
        $this->_pageFactory = $pageFactory;
        $this->_cleanCache = $cleanCache;
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('NgocThanh_Blog::delete');
    }

    public function execute()
    {
        $postId = $this->getRequest()->getParam("id");
        $postModel = $this->_postFactory->create();
        $entity = $postModel->load($postId);
        $listProduct = $this->_relatedProduct
            ->create()->addFieldToFilter("post_id", ["eq" => $postId]);
        if (isset($entity)) {
            try {
                $postModel->getResource()->deletePostCategory($postId);
                $postModel->getResource()->deletePostTag($postId);
                $entity->delete();
                foreach ($listProduct as $item) {
                    $item->delete();
                }
                $this->_cleanCache->cacheFunction();
                $this->messageManager->addSuccessMessage(__('Record have been Delete.'));
                return $this->_redirect($this->getUrl("*/*/"));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('Error!.'));
                return $this->_redirect($this->getUrl("*/*/"));
            }
        }
    }
}
