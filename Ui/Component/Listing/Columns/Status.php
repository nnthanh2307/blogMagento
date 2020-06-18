<?php

namespace NgocThanh\Blog\Ui\Component\Listing\Columns;
use Magento\Framework\Option\ArrayInterface;

/**
 * Class Status
 * @package NgocThanh\Blog\Ui\Component\Listing\Columns
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
                'label' => "Disable",
                'value' => 0,
            ],
            [
                'label' => "Enable",
                'value' => 1,
            ],

        ];
    }
}
