<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Category\Category;

/**
 * Class GetTag
 * @package NgocThanh\Blog\Block\Blog
 */
class GetTag extends \Magento\Framework\View\Element\Template
{
    /**
     * @var array
     */
    private $array = [];
    /**
     * @var Category
     */
    protected $_category;

    /**
     * GetTag constructor.
     * @param array $data
     * @param Template\Context $context
     * @param Category $category
     */
    public function __construct(
        array $data = [],
        Template\Context $context,
        Category $category
    )
    {
        $this->_category = $category;
        parent::__construct($context, $data);
    }

    /**
     * @param $url
     * @return string
     */
    public function tagUrl($url)
    {
        return $this->getUrl("*/*/*/tag/$url");
    }

}


