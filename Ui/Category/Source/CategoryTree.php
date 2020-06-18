<?php

namespace NgocThanh\Blog\Ui\Category\Source;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class CategoryTree
 * @package NgocThanh\Blog\Ui\Category\Source
 */
class CategoryTree extends Column
{
    /**
     * @var array
     */
    private $array = [];
    /**
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

        $resource = $dataSource["data"]["items"];
        $this->categoryTree($resource);
        $dataSource["data"]["items"] = $this->array;
        return $dataSource;
    }

    /**
     * @param $categories
     * @param int $parent_id
     * @param string $char
     */
    public function categoryTree($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => &$item) {
            if ($item['parent_id'] == $parent_id) {
                $item["category_name"] = $char . $item["category_name"];
                $this->array[] = $item;
                unset($categories[$key]);
                $this->categoryTree($categories, $item['category_id'], $char . '-------|  ');
            }
        }
    }
}
