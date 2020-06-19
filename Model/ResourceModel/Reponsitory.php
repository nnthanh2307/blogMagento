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

    public function returnTag($id)
    {
        $sql = "SELECT tag_name FROM tag INNER JOIN post_tag ON tag.tag_id = post_tag.tag_id WHERE post_id = '{$id}' ";
        return $this->getConnection()->fetchAll($sql);
    }
    public function returnCategory($id)
    {
        $sql = "SELECT category_name FROM category INNER JOIN  post_category ON category.category_id = post_category.category_id WHERE post_id = '{$id}'";
        return $this->getConnection()->fetchAll($sql);
    }
}
