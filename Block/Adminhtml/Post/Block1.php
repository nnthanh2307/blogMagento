<?php

namespace NgocThanh\Blog\Block\Adminhtml\Post;

use Magento\Framework\View\Element\Template;

class Block1 extends \Magento\Framework\View\Element\Template
{
    protected $_scopeConfigInterFace;

    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterFace
        )
    {
        $this->_scopeConfigInterFace = $scopeConfigInterFace;
        parent::__construct($context, $data);
    }

    public function getConfig()
    {
        $result = [];
        array_push(
            $result,
            $this->_scopeConfigInterFace->getValue("blog/general2/display_text", \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
        );
        array_push(
            $result,
            $this->_scopeConfigInterFace->getValue("blog/general2/enable", \Magento\Store\Model\ScopeInterface::SCOPE_STORE)
    );
        return $result;
    }

    public function reques()
    {
        return $this->getRequest()->getParams();

    }

}

?>
