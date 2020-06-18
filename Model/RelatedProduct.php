<?php

namespace NgocThanh\Blog\Model;

/**
 * Class Category
 * @package NgocThanh\Blog\Model
 */
class RelatedProduct extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\ResourceModel\RelatedProduct::class);
    }
}
?>
