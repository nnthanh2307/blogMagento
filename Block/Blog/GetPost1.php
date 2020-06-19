<?php

namespace NgocThanh\Blog\Block\Blog;

use Magento\Backend\Block\Template;
use NgocThanh\Blog\Helper\Config\GetConfig;
use NgocThanh\Blog\Helper\Post\Post;

class GetPost1 extends Template
{
    protected $postCollectionFactory;
    protected $postFactory;
    protected $_config;

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

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

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

    public function postURL($id)
    {
        return $this->getUrl("*/view/post/id/$id");
    }

    public function getTag($id)
    {
        $tag =  $this->postCollectionFactory->getListPost()->getResource()->returnTag($id);
        $array = [];
        foreach ($tag as $item)
            $array[] = $item["tag_name"];
        return implode(", ",$array);
    }

    public function getCategory($id)
    {
        $tag =  $this->postCollectionFactory->getListPost()->getResource()->returnCategory($id);
        $array = [];
        foreach ($tag as $item)
            $array[] = $item["category_name"];
        return implode(", ",$array);
    }
}
