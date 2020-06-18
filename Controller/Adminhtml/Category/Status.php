<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use NgocThanh\Blog\Model\ResourceModel\Category\CollectionFactory;

class Status extends Action
{
    protected $filter;

    protected $collectionFactory;

    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

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
    public function getCollection()
    {
        $listId = $this->getRequest()->getParams()["selected"];
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter($collection->getIdFieldName(), ["in" => $listId]);
        return $collection;
    }
}
