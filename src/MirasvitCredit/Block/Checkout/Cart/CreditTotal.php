<?php
namespace Mirasvit\MirasvitCredit\Block\Checkout\Cart;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\View\Element\Template\Context;
use Mirasvit\Credit\Helper\Data as CreditHelper;

class CreditTotal extends \Magento\Checkout\Block\Cart\AbstractCart
{
    protected CreditHelper $creditHelper;

    protected $context;

    protected $customerSession;

    protected $customer;

    public function __construct(
        CreditHelper $creditHelper,
        CustomerSession $customerSession,
        CheckoutSession $checkoutSession,
        Context $context,
        array $data = []
    ) {
        $this->creditHelper = $creditHelper;
        $this->customerSession = $customerSession;
        $this->context = $context;
        parent::__construct($context, $customerSession, $checkoutSession, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('Hyva_MirasvitCredit::checkout/cart/credit-total.phtml');
    }

    public function _toHtml(): string
    {
        if (!$this->customerSession->isLoggedIn()) {
            return '';
        }

        return parent::_toHtml();
    }

    public function getUsedAmount(): float
    {
        return $this->creditHelper->getQuote()->getCreditAmountUsed();
    }
}
