<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use NgocThanh\Blog\Model\ResourceModel\Category\CollectionFactory;

/**
 * Class Status
 * @package NgocThanh\Blog\Controller\Adminhtml\Category
 */
class Status extends Action
{
    /**
     * @var Filter
     */
    protected $filter;
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Status constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $status = $this->getRequest()->getParam("status");
        $collection = $this->getCollection();
        $collectionSize = $collection->getSize();
        try {
            foreach ($collection as $item) {
                $item->setData("status", $status);
                $item->save();
            }
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been update.', $collectionSize));
            return $this->_redirect($this->getUrl("*/*/"));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage(__('Do not update status.'));
            return $this->_redirect($this->getUrl("*/*/"));
        }
    }

    /**
     * @return \NgocThanh\Blog\Model\ResourceModel\Category\Collection
     */
    public function getCollection()
    {
        $listId = $this->getRequest()->getParams()["selected"];
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter($collection->getIdFieldName(), ["in" => $listId]);
        return $collection;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('NgocThanh_Blog::edit');
    }
}
