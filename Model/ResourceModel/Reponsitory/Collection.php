<?php
namespace NgocThanh\Blog\Model\ResourceModel\Reponsitory;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = "post_id";

    protected function _construct()
    {
        $this->_init(\NgocThanh\Blog\Model\Reponsitory::class, \NgocThanh\Blog\Model\ResourceModel\Reponsitory::class);
    }

    /**
     * @return Collection|void
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->insertCategory();
        $this->insertTag();
        $this->insertRelatedProduct();
    }

    /**
     * @return $this
     */
    public function insertCategory()
    {
        $postID = [];
        $blogCategory =[];
        foreach ($this as $item) {
            $postID[$item->getId()] = $item->getId();
        }

        if (!empty($postID)) {
            $result = $this->getConnection()->select()->from(
                ["post_category" => "post_category"]
            )->join(
                ["category" => $this->getResource()->getTable("category")],
                "post_category.category_id = category.category_id",
                ["category_name"]
            )->where(
                'post_category.post_id IN (?)',
                array_keys($postID)
            );

            $data = $this->getConnection()->fetchAll($result);
            foreach ($data as $item) {
                $blogCategory[$item["post_id"]][] = $item["category_id"];
                $blogCategoryName[$item["post_id"]][] = $item["category_name"];
            }

            foreach ($this as $item) {
                if (isset($blogCategory[$item->getId()])) {
                    $item->setData("category_id", $blogCategory[$item->getId()]);
                    $item->setData("category_name", $blogCategoryName[$item->getId()]);
                }
            }
        }
    }

    /**
     * @return $this
     */
    public function insertTag()
    {
        $postID = [];
        $product =[];
        foreach ($this as $item) {
            $postID[$item->getId()] = $item->getId();
        }
        if (!empty($postID)) {
            $result = $this->getConnection()->select()->from(
                ["post_tag" => "post_tag"]
            )->join(
                ["tag" => $this->getResource()->getTable("tag")],
                "post_tag.tag_id = tag.tag_id",
                ["tag_name"]
            )->where(
                'post_tag.post_id IN (?)',
                array_keys($postID)
            );

            $data = $this->getConnection()->fetchAll($result);
            foreach ($data as $item) {
                $blogTag[$item["post_id"]][] = $item["tag_id"];
                $blogTagName[$item["post_id"]][] = $item["tag_name"];
            }
            foreach ($this as $item) {
                if (isset($blogTag[$item->getId()])) {
                    $item->setData("tag_id", $blogTag[$item->getId()]);
                    $item->setData("tag_name", $blogTagName[$item->getId()]);
                }
            }
        }
        return $this;
    }

    public function insertRelatedProduct()
    {
        $postID = [];
        foreach ($this as $item) {
            $postID[$item->getId()] = $item->getId();
        }
        if (!empty($postID)) {
            $result = $this->getConnection()->select()->from(
                ["related_product" => "related_product"]
            )->join(
                ["post" => $this->getResource()->getTable("post")],
                "post.post_id = related_product.post_id",
                ["post_id"]
            );

            $data = $this->getConnection()->fetchAll($result);

            foreach ($data as $item) {
                $product[$item["post_id"]]["related_product"][] = $item;
            }

            foreach ($this as $item) {
                if (isset($product[$item->getId()])) {
                    $item->setData("links", $product[$item->getId()]);
                }
            }
        }
        return $this;
    }
}
