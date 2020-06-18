<?php
namespace NgocThanh\Blog\Model\ResourceModel;

/**
 * Class Post
 * @package NgocThanh\Blog\Model\ResourceModel
 */
class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var string
     */
    protected $main_table = "post";
    protected function _construct()
    {
        $this->_init("post", "post_id");
    }

    /**
     * @return false|\Magento\Framework\DB\Adapter\AdapterInterface
     */
    public function getConnect()
    {
        return $this->getConnection();
    }

    /**
     * @param $data
     * @param $id
     */
    public function savePostCateogry($data, $id)
    {
        $sql = "INSERT INTO post_category (post_id,category_id) VALUES ($id,$data)";
        $this->getConnect()->query($sql);
    }

    /**
     * @param $data
     * @param $id
     */
    public function savePostTag($data, $id)
    {
        $sql = "INSERT INTO post_tag (post_id,tag_id) VALUES ($id,$data)";
        $this->getConnect()->query($sql);
    }

    /**
     * @param $id
     */
    public function deletePostCategory($id)
    {
        $sql = "DELETE FROM post_category where post_id = '{$id}'";
        $this->getConnect()->query($sql);
    }

    /**
     * @param $id
     */
    public function deletePostTag($id)
    {
        $sql = "DELETE FROM post_tag where post_id = '{$id}'";
        $this->getConnect()->query($sql);
    }

    public function deleteRelatedProduct($id)
    {
        $sql = "DELETE FROM related_product WHERE post_id = '{$id}'";
        $this->getConnect()->query($sql);
    }
}
