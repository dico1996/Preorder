<?php
namespace Dico\Preorder\Observer;

use Magento\Framework\Event\ObserverInterface;

class Observer implements ObserverInterface
{

    protected $helper;

    public function __construct(\Dico\Preorder\Helper\Data $helper)
    {
        $this->helper = $helper;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $item = $observer->getItem();
        $backorders = $item->getBackorders();
        $discount = $this->helper->getConfigValue('preorder/preorder_discount/discount');
        $finalDiscount = $item->getPrice() * $backorders * $discount / 100;
        $item->setDiscountAmount($finalDiscount);
        $item->setBaseDiscountAmount($finalDiscount);
    }
}