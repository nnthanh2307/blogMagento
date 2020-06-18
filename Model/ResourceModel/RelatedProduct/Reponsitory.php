<?php
namespace Ngocthanh\Blog\Model\ResourceModel\RelatedProduct;

/**
 * Class Collection
 * @package Ngocthanh\Blog\Model\ResourceModel\Post
 */
class Reponsitory extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = "related_id";

    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\RelatedProduct::class, \NgocThanh\Blog\Model\ResourceModel\RelatedProduct::class);
    }
}
