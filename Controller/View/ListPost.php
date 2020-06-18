<?php

namespace NgocThanh\Blog\Controller\View;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class ListPost
 * @package NgocThanh\Blog\Controller\View
 */
class ListPost extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;
    protected $_categoryFactory;

    /**
     * ListPost constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param \NgocThanh\Blog\Model\PostFactory $postFactory
     * @param \NgocThanh\Blog\Model\CategoryFactory $categoryFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        \NgocThanh\Blog\Model\PostFactory $postFactory,
        \NgocThanh\Blog\Model\CategoryFactory $categoryFactory
    ) {
        $this->_postFactory = $postFactory;
        $this->_pageFactory = $pageFactory;
        $this->_categoryFactory = $categoryFactory;
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
