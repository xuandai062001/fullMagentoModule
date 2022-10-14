<?php
namespace Mageplaza\CustomCheckoutFields\Plugin\Checkout\Model;

class ShippingInformationManagement
{
    protected $_logger;
 
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    )
    {        
        $this->_logger = $logger;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $shippingAddress = $addressInformation->getShippingAddress();
        $shippingExtensionAttributes = $shippingAddress->getExtensionAttributes();
        if($shippingAddress->setOrderBy($shippingExtensionAttributes->getOrderBy())){
            $this->_logger->debug('Save successfully');
        }
       
        $this->_logger->debug('====================MY LOG=======================');
        $this->_logger->debug('Order by ' . $shippingExtensionAttributes->getOrderBy());
        $this->_logger->debug('Order by ' . $shippingAddress->getOrderBy());
    }
}
