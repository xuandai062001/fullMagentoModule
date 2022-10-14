<?php
namespace Xuandai_CustomCheckoutFields\Plugin\Magento\Quote\Model;

class ShippingAddressManagement
{
    protected $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function beforeAssign(
        \Magento\Quote\Model\ShippingAddressManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address
    ) {

        $extAttributes = $address->getExtensionAttributes();

        $this->_logger->debug('====================MY LOG=======================');
        $this->_logger->debug('Order by ' . $address->getOrderBy());

        if (!empty($extAttributes)) {

            try {
                $address->setOrderBy($address->getOrderBy());
            } catch (\Exception $e) {
                $this->logger->debug($e->getMessage());
            }

        }

    }
}