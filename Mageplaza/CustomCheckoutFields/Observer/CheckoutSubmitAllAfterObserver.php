<?php
namespace Mageplaza\CustomCheckoutFields\Observer;

class CheckoutSubmitAllAfterObserver implements \Magento\Framework\Event\ObserverInterface
{

    protected $_logger;
 
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    )
    {        
        $this->_logger = $logger;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        if (empty($order) || empty($quote)) {
            return $this;
        }

        $shippingAddress = $quote->getShippingAddress();
        
        $this->_logger->debug('====================MY LOG=======================');
        $this->_logger->debug('Order by ' . $shippingAddress->getData('order_by'));
        // $this->_logger->debug('shipping address: ' . $shippingAddress);
        

        if ($shippingAddress->getOrderBy()) {
            $orderShippingAddress = $order->getShippingAddress();
            $orderShippingAddress->setOrderBy(
                $shippingAddress->getOrderBy()
            )->save();
        }

        return $this;
    }
}
