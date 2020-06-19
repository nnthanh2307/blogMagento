<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use NgocThanh\Blog\Model\PostFactory;
use NgocThanh\Blog\Model\ResourceModel\Post\CollectionFactory;
use NgocThanh\Blog\Model\ResourceModel\RelatedProduct\CollectionFactory as relatedProductCollection;
use NgocThanh\Blog\Helper\Cache\CleanCache;

class MassDelete extends Action
{
    protected $filter;
    protected $_postFactory;
    protected $_relatedProduct;
    protected $_cleanCache;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PostFactory $postFactory,
        CleanCache $cleanCache,
        relatedProductCollection $relatedProduct
    ) {
        $this->_relatedProduct = $relatedProduct;
        $this->_postFactory = $postFactory;
        $this->_cleanCache = $cleanCache;
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('NgocThanh_Blog::delete');
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        $relatedProductCollection = $this->_relatedProduct->create();
        $postResourceModel = $this->_postFactory->create()->getResource();
        try {
            foreach ($collection as $item) {
                $postResourceModel->deletePostCategory($item->getId());
                $postResourceModel->deletePostTag($item->getId());
                $listProduct = $relatedProductCollection
                    ->addFieldToFilter("post_id", ["eq" => $item->getId()]);
                foreach ($listProduct as $item) {
                    $item->delete();
                }

                $item->delete();
            }
            $this->_cleanCache->cacheFunction();
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
            return $this->_redirect($this->getUrl("*/*/"));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage(__("Error Delete Function!"));
            return $this->_redirect($this->getUrl("*/*/"));
        }
    }
}
