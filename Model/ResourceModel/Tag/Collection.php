<?php
namespace NgocThanh\Blog\Model\ResourceModel\Tag;

/**
 * Class Collection
 * @package NgocThanh\Blog\Model\ResourceModel\Tag
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = "tag_id";
    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\Tag::class, \NgocThanh\Blog\Model\ResourceModel\Tag::class);
    }
}
?>
