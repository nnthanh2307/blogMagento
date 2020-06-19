<?php
namespace NgocThanh\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use NgocThanh\Blog\Helper\Post\Post;

/**
 * Class GetPost
 * @package NgocThanh\Blog\Block\Blog
 */
class GetPost extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Post
     */
    protected $_post;

    /**
     * GetPost constructor.
     * @param array $data
     * @param Template\Context $context
     * @param Post $post
     */
    public function __construct(
        array $data = [],
        Template\Context $context,
        Post $post
    ) {
        $this->_post = $post;
        parent::__construct($context, $data);
    }

    public function getPost()
    {
        $params = $this->getRequest()->getParams();
        $post = $this->_post->getListPost();
        if (!empty($params["search"])) {
            $post->addFieldToFilter("post_title", ["like" => "%{$params["search"]}%"]);
        }
        $post->setPageSize(5);
        $post->setCurPage(1);
        if (isset($params["num"])) {
            $post->setPageSize($params["num"]);
        }
        if (isset($params["page"])) {
            $post->setCurPage($params["page"]);
        }
        return $this->checkDate($post->getData());
    }

    public function checkDate($array)
    {
        $result = [];
        $timeNow = date("m/d/y G.i:s");
        foreach ($array as $item) {
            if (strtotime($timeNow) > strtotime($item["publish_date_from"]) && strtotime($timeNow) < strtotime($item["publish_date_to"]) && $item["status"] == 1) {
                $result[] = $item;
            }
        }
        return $result;
    }

    public function postURL($id)
    {
        return $this->getUrl("*/view/post/id/$id");
    }
}
