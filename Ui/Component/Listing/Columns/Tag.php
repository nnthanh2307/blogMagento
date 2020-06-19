<?php

namespace NgocThanh\Blog\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Tag
 * @package NgocThanh\Blog\Ui\Component\Listing\Columns
 */
class Tag extends Column
{
    /**
     * Tag constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
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
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource["data"]["items"] as &$item) {
            if (!empty($item["tag_name"]))
                $item["tag"] = implode(", ", $item["tag_name"]);
        }
        return $dataSource;
    }
}
