<?php

namespace NgocThanh\Blog\Controller\View;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Post
 * @package NgocThanh\Blog\Controller\View
 */
class Post extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    /**
     * @var \NgocThanh\Blog\Model\PostFactory
     */
    protected $_postFactory;
    /**
     * @var \NgocThanh\Blog\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * Post constructor.
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
