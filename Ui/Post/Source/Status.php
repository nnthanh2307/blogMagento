<?php

namespace NgocThanh\Blog\Ui\Post\Source;
use Magento\Framework\Option\ArrayInterface;

/**
 * Class Status
 * @package NgocThanh\Blog\Ui\Post\Source
 */
class Status implements ArrayInterface
{
    /**
     * @return array|array[]
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => "Draft",
                'value' => 0,
            ],
            [
                'label' => "Pending",
                'value' => 1,
            ],
            [
                'label' => "Published",
                'value' => 2,
            ],
        ];
    }
}
