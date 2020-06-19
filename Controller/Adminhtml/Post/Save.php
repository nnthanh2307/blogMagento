<?php

namespace NgocThanh\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use NgocThanh\Blog\Helper\Cache\CleanCache;
use NgocThanh\Blog\Model\PostFactory;
use NgocThanh\Blog\Model\RelatedProductFactory;
use NgocThanh\Blog\Model\TagFactory;

/**
 * Class Save
 * @package NgocThanh\Blog\Controller\Adminhtml\Post
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    protected $_postFactory;
    protected $_tagFactory;
    protected $_relatedProduct;
    protected $_relatedCollection;
    protected $_cleanCache;

    /**
     * Save constructor.
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param PostFactory $postFactory
     * @param TagFactory $tagFactory
     * @param RelatedProductFactory $relatedProductFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        PostFactory $postFactory,
        TagFactory $tagFactory,
        RelatedProductFactory $relatedProductFactory,
        CleanCache $cleanCache
    ) {
        $this->_cleanCache = $cleanCache;
        $this->_relatedProduct = $relatedProductFactory;
        $this->_tagFactory = $tagFactory;
        $this->_postFactory = $postFactory;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $postId = "";
        $data = $this->processParams();
        $postModel = $this->_postFactory->create();
        $postCollection = $postModel->getCollection();
        $postCollection->addFieldToFilter("post_title", ["like" => "%{$data["post"]["post_title"]}%"]);
        $postSize = $postCollection->getSize();

        if ($postSize > 0 && !isset($data["post"]["post_id"])) {
            $this->messageManager->addErrorMessage(__('Do not create 2 Blog same same.'));
            return $this->_redirect($this->getUrl("*/*/"));
        } else {
            if (isset($data)) {
                $postModel->addData($data["post"]);
                $postId = $postModel->save()->getId();
//            $postModel->getResource()->deleteRelatedProduct($postId);
                if (!empty($data["tag"])) {
                    if ($postModel->getResource()->getConnect()->fetchAll("SELECT COUNT(*) FROM post_category WHERE post_id = '{$postId}'") > 0) {
                        $postModel->getResource()->deletePostTag($postId);
                    }
                    foreach ($data["tag"] as $item) {
                        $postModel->getResource()->savePostTag($item, $postId);
                    }
                }
                if (!empty($data["category"])) {
                    if ($postModel->getResource()->getConnect()->fetchAll("SELECT COUNT(*) FROM post_tag WHERE post_id = '{$postId}'") > 0) {
                        $postModel->getResource()->deletePostCategory($postId);
                    }
                    foreach ($data["category"] as $item) {
                        $postModel->getResource()->savePostCateogry($item, $postId);
                    }
                }
                if (!empty($data["relatedProduct"])) {
                    foreach ($data["relatedProduct"] as $item) {
                        $item["post_id"] = $postId;
                        $this->_relatedProduct->create()->addData($item)->save();
                    }
                }
                $this->_cleanCache->cacheFunction();
                $this->messageManager->addSuccessMessage(__('Record have been Saved.'));
                return $this->_redirect($this->getUrl("*/*/"));
            }
        }
    }

    /**
     * @return array
     */
    protected function processParams()
    {
        $result = [];
        $relatedProduct = [];
        $data = $this->getRequest()->getParams();
        if (!empty($data["category_id"]))
            $result["category"] = $data["category_id"];
        if (!empty($data["tag_id"]))
            $result["tag"] = $data["tag_id"];
        if (!empty($data["links"])) {
            $relatedProduct = $data["links"]["related_product"];
            $result["relatedProduct"]= $relatedProduct;
        }
        unset(
            $data["key"],
            $data["blog_product_listing"],
            $data["form_key"],$data["links"],
            $data["category_id"],
            $data["tag"],
            $data["tag_id"]
        );
        $result["post"] = $data;
        if (!isset($data["status"])) {
            $result["post"]["status"] = 0;
        }

        if (!isset($data["thumbnail"][0]["url"])) {
            $result["post"]["thumbnail"] = null;
        } else {
            $result["post"]["thumbnail"] = $data["thumbnail"][0]["url"];
        }
        return $result;
    }
}
