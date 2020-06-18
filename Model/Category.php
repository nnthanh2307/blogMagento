<?php

namespace NgocThanh\Blog\Model;

/**
 * Class Category
 * @package NgocThanh\Blog\Model
 */
class Category extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\ResourceModel\Category::class);
    }
}
?>
