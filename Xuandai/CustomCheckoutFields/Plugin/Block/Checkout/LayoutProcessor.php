<?php
namespace Xuandai\CustomCheckoutFields\Plugin\Block\Checkout;

class LayoutProcessor
{
    /**
     * Process js Layout of block
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, $jsLayout)
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['order_by'] = $this->processOrderByAddress('shippingAddress');

        return $jsLayout;
    }

    /**
     * Process provided address.
     *
     * @param string $dataScopePrefix
     * @return array
     */
    private function processOrderByAddress($dataScopePrefix)
    {
        return [
            'component' => 'Magento_Ui/js/form/element/textarea',
            'config' => [
                'customScope' => $dataScopePrefix.'.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/textarea',
                'id' => 'order_by',
            ],
            'dataScope' => $dataScopePrefix.'.custom_attributes.order_by',
            'label' => __('Order By'),
            'provider' => 'checkoutProvider',
            'validation' => [
               'required-entry' => true
            ],
            'sortOrder' => 201,
            'visible' => true,
            'imports' => [
                'initialOptions' => 'index = checkoutProvider:dictionaries.order_by',
                'setOptions' => 'index = checkoutProvider:dictionaries.order_by'
            ]
        ];
    }
}
