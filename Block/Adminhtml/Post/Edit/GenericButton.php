<?php

namespace NgocThanh\Blog\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Context;
use NgocThanh\Blog\Model\PostFactory;

class GenericButton
{
    protected $context;

    protected $_postFactory;

    public function __construct(
        Context $context,
        PostFactory $postFactory
    ) {
        $this->context = $context;
        $this->_postFactory = $postFactory;
    }

    public function getPostId()
    {
        return $this->context->getRequest()->getParam("id");
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
