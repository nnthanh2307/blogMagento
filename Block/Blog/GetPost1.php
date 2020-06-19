<?php

namespace NgocThanh\Blog\Block\Blog;

use Magento\Backend\Block\Template;
use NgocThanh\Blog\Helper\Config\GetConfig;
use NgocThanh\Blog\Helper\Post\Post;

/**
 * Class GetPost1
 * @package NgocThanh\Blog\Block\Blog
 */
class GetPost1 extends Template
{
    /**
     * @var Post
     */
    protected $postCollectionFactory;
    /**
     * @var
     */
    protected $postFactory;
    /**
     * @var GetConfig
     */
    protected $_config;

    /**
     * GetPost1 constructor.
     * @param Template\Context $context
     * @param \Magento\Framework\App\Request\Http $request
     * @param Post $post
     * @param GetConfig $config
     */
    public function __construct(
        Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        Post $post,
        GetConfig $config
    ) {
        $this->_config = $config;
        $this->postCollectionFactory = $post;
        parent::__construct($context);
    }

    /**
     * @return $this|GetPost1
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('List Blog'));
        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'custom.history.pager'
        )->setAvailableLimit($this->returnNumber())
            ->setShowPerPage(true)->setCollection(
                $this->getPost()
            );
        $this->setChild('pager', $pager);
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return array
     */
    public function returnNumber()
    {
        $result = [];
        $string = $this->_config->getNumberPerPage();
        $number = explode(",", $string);
        foreach ($number as $item) {
            $result[(int)$item] = (int)$item;
        }
        return $result;
    }

    /**
     * @return \NgocThanh\Blog\Model\ResourceModel\Reponsitory\Collection
     */
    public function getPost()
    {
        $now = new \DateTime();
        $collection = $this->postCollectionFactory->getListPost();
        $number = $this->returnNumber();
        $first = (int)reset($number);
        $collection->addFieldToFilter("status", ["eq" => 1]);
        $collection->addFieldToFilter("publish_date_from", ["lteq" => $now->format('Y-m-d H:i:s')]);
        $collection->addFieldToFilter("publish_date_to", ["gt" => $now->format('Y-m-d H:i:s')]);

        $search = ($this->getRequest()->getParam('search'))
            ? $this->getRequest()->getParam('search') : "";

        if (!empty($search)) {
            $collection->addFieldToFilter("post_title", ["like" => "%{$search}%"]);
        }
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : $first;

        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    /**
     * @param $id
     * @return string
     */
    public function postURL($id)
    {
        return $this->getUrl("*/view/post/id/$id");
    }

    /**
     * @param $id
     * @return string
     */
    public function getTag($id)
    {
        $tag =  $this->postCollectionFactory->getListPost()->getResource()->returnTag($id);
        $array = [];
        foreach ($tag as $item)
            $array[] = $item["tag_name"];
        return implode(", ",$array);
    }

    /**
     * @param $id
     * @return string
     */
    public function getCategory($id)
    {
        $tag =  $this->postCollectionFactory->getListPost()->getResource()->returnCategory($id);
        $array = [];
        foreach ($tag as $item)
            $array[] = $item["category_name"];
        return implode(", ",$array);
    }
}
