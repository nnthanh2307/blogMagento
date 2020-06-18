<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Category\Category;

class GetTag extends \Magento\Framework\View\Element\Template
{
    private $array = [];

    protected $_category;
    public function __construct(
        array $data = [],
        Template\Context $context,
        Category $category
    )
    {
        $this->_category = $category;
        parent::__construct($context, $data);
    }

    public function listTag()
    {
//        $lisTag = $this->_category->getResource()
//            ->getConnect()->query("SELECT * FROM tag");
//        echo "<pre>";
//        var_dump($lisTag);
//        die(__METHOD__);
    }

    public function tagUrl($url)
    {
        return $this->getUrl("*/*/*/tag/$url");
    }

}


