<?php
namespace NgocThanh\Blog\Model\ResourceModel;

/**
 * Class Reponsitory
 * @package NgocThanh\Blog\Model\ResourceModel
 */
class Reponsitory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("post", "post_id");
    }
}
