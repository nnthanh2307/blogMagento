<?php

namespace NgocThanh\Blog\Model;

/**
 * Class Reponsitory
 * @package NgocThanh\Blog\Model
 */
class Reponsitory extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\ResourceModel\Reponsitory::class);
    }
}

?>
