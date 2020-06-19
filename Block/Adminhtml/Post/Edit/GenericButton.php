<?php

namespace NgocThanh\Blog\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Context;
use NgocThanh\Blog\Model\PostFactory;

/**
 * Class GenericButton
 * @package NgocThanh\Blog\Block\Adminhtml\Post\Edit
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var PostFactory
     */
    protected $_postFactory;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param PostFactory $postFactory
     */
    public function __construct(
        Context $context,
        PostFactory $postFactory
    ) {
        $this->context = $context;
        $this->_postFactory = $postFactory;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->context->getRequest()->getParam("id");
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
