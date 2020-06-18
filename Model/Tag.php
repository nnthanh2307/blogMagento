<?php

namespace NgocThanh\Blog\Model;

/**
 * Class Tag
 * @package NgocThanh\Blog\Model
 */
class Tag extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\ResourceModel\Tag::class);
    }
}

?>
