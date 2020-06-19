<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Category\Category;

/**
 * Class GetCategory
 * @package NgocThanh\Blog\Block\Blog
 */
class GetCategory extends \Magento\Framework\View\Element\Template
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
     * GetCategory constructor.
     * @param array $data
     * @param Template\Context $context
     * @param Category $category
     */
    public function __construct(
        array $data = [],
        Template\Context $context,
        Category $category
    ) {
        $this->_category = $category;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function listCategory()
    {
        $list= $this->_category->getCategory()->addFieldToFilter("status", ["eq" => '1'])->getData();
        $this->categoryTree($list);
        return $this->array;
    }

    /**
     * @param $url
     * @return string
     */
    public function categoryUrl($url)
    {
        return $this->getUrl("*/*/listpost/category/$url");
    }

    /**
     * @param $categories
     * @param int $parent_id
     * @param string $char
     */
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
