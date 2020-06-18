<?php

namespace NgocThanh\Blog\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class CategoryAction
 * @package NgocThanh\Blog\Ui\Component\Listing\Columns
 */
class CategoryAction extends Column
{
    /**
     * @var UrlInterface
     */
    protected $_urlBuilder;
    const PATH_EDIT = "blog/category/edit";
    const PATH_DELETE = "blog/category/delete";

    /**
     * CategoryAction constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->_urlBuilder->getUrl(
                            static::PATH_EDIT,
                            [
                                'id' => $item['category_id']
                            ]
                        ),
                        'label' => __('Edit')
                    ],
                    'delete' => [
                        'href' => $this->_urlBuilder->getUrl(
                            static::PATH_DELETE,
                            [
                                'id' => $item['category_id']
                            ]
                        ),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete'),
                            'message' => __('Are you sure you wan\'t to delete a record?'),
                        ],
                    ],
                ];
            }
        }
        return $dataSource;
    }
}
?>
