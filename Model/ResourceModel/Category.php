<?php
namespace NgocThanh\Blog\Model\ResourceModel;

/**
 * Class Category
 * @package NgocThanh\Blog\Model\ResourceModel
 */
class Category extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("category", "category_id");
    }

}
