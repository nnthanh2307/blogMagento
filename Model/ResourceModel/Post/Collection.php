<?php
namespace Ngocthanh\Blog\Model\ResourceModel\Post;

/**
 * Class Collection
 * @package Ngocthanh\Blog\Model\ResourceModel\Post
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = "post_id";

    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\Post::class, \NgocThanh\Blog\Model\ResourceModel\Post::class);
    }
}
