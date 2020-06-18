<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use NgocThanh\Blog\Model\CategoryFactory;

class Save extends \Magento\Backend\App\Action
{
    protected $_categoryFactory;

    public function __construct(
        Context $context,
        CategoryFactory $categoryFactory
    ) {

        parent::__construct($context);
        $this->_categoryFactory = $categoryFactory;
    }

    public function execute()
    {
        $categoryModel = $this->_categoryFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            unset($data["form_key"]);
            if ($data["status"] == null || $data["status"]) {
                $data["status"] = 0;
            }
            try {
                $categoryModel->addData($data);
                $categoryModel->save();
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('Do not save category.'));
                return $this->_redirect($this->getUrl("*/*/"));
            }
            $this->messageManager->addSuccessMessage(__('Record have been Saved.'));
            return $this->_redirect($this->getUrl("*/*/"));
        }
    }
}
