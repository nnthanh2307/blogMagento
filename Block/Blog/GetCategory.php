<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Category\Category;

class GetCategory extends \Magento\Framework\View\Element\Template
{
    private $array = [];

    protected $_category;
    public function __construct(
        array $data = [],
        Template\Context $context,
        Category $category
    ) {
        $this->_category = $category;
        parent::__construct($context, $data);
    }

    public function listCategory()
    {
        $list= $this->_category->getCategory()->addFieldToFilter("status", ["eq" => '1'])->getData();
        $this->categoryTree($list);
        return $this->array;
    }

    public function categoryUrl($url)
    {
        return $this->getUrl("*/*/listpost/category/$url");
    }

    public function categoryTree($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => &$item) {
            if ($item['parent_id'] == $parent_id) {
                $item["category_name"] = $char . $item["category_name"];
                $this->array[] = $item;
                unset($categories[$key]);
                $this->categoryTree($categories, $item['category_id'], $char . '-------  ');
            }
        }
    }
}
