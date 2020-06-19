<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 * @package NgocThanh\Blog\Controller\Adminhtml\Category
 */
class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory
        )
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('NgocThanh_Blog::edit');
    }
}

?>
