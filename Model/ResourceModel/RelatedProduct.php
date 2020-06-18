<?php
namespace NgocThanh\Blog\Model\ResourceModel;

/**
 * Class Category
 * @package NgocThanh\Blog\Model\ResourceModel
 */
class RelatedProduct extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("related_product", "related_id");
    }
}
