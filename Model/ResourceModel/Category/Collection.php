<?php
namespace NgocThanh\Blog\Model\ResourceModel\Category;

/**
 * Class Collection
 * @package NgocThanh\Blog\Model\ResourceModel\Category
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = "category_id";

    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\Category::class, \NgocThanh\Blog\Model\ResourceModel\Category::class);
    }
}
?>
