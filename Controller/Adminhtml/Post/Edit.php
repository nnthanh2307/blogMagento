<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 * @package NgocThanh\Blog\Controller\Adminhtml\Post
 */

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfiginterface;
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * GetConfig constructor.
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface
     */
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface
    )
    {
        $this->_scopeConfiginterface = $scopeConfigInterface;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }


}
?>
