<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use NgocThanh\Blog\Model\CategoryFactory;

/**
 * Class Save
 * @package NgocThanh\Blog\Controller\Adminhtml\Category
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param CategoryFactory $categoryFactory
     */
    public function __construct(
        Context $context,
        CategoryFactory $categoryFactory
    ) {

        parent::__construct($context);
        $this->_categoryFactory = $categoryFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
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
