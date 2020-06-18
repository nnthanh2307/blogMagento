<?php

namespace NgocThanh\Blog\Model;

/**
 * Class Post
 * @package NgocThanh\Blog\Model
 */
class Post extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\ResourceModel\Post::class);
    }
}

?>
