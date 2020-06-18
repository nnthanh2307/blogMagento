<?php
namespace NgocThanh\Blog\Model\ResourceModel;

/**
 * Class Tag
 * @package NgocThanh\Blog\Model\ResourceModel
 */
class Tag extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("tag","tag_id");
    }
}
?>
