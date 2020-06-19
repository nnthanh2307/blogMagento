<?php

namespace NgocThanh\Blog\Helper\Config;

use \Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class GetConfig
 * @package NgocThanh\Blog\Helper\Config
 */
class GetConfig
{
    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * GetConfig constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_scopeConfig->getValue("blog/general/enable", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->_scopeConfig->getValue("blog/general/name_in_frontend", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getNumberPerPage()
    {
        return $this->_scopeConfig->getValue("blog/general/number_per_page", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->_scopeConfig->getValue("blog/seo/base_url", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getSuffixPost()
    {
        return $this->_scopeConfig->getValue("blog/seo/suffix_post", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getSuffixCategory()
    {
        return $this->_scopeConfig->getValue("blog/seo/suffix_cagtegory", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}

?>
