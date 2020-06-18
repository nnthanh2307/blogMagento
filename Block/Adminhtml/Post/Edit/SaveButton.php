<?php
namespace NgocThanh\Blog\Block\Adminhtml\Post\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        return [
            'label'          => __('Save'),
            'class'          => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save',
                    'target' => '#blog_post_form',
                    'eventData' => ['action' => '*/*/save']]
                ],
                'form-role' => 'save',
            ],
            'sort_order'     => 90,
        ];
    }

}
