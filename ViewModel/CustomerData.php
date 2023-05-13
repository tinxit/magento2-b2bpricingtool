<?php

declare(strict_types=1);

namespace TinxiT\B2bpricingtool\ViewModel;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;


/**
 *
 */
class CustomerData implements ArgumentInterface
{

    /**
     * @param CurrentCustomer $currentCustomer
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        private readonly CurrentCustomer $currentCustomer,
        private readonly CustomerRepositoryInterface $customerRepository,
    )
    {}

    /**
     * @return string|void
     */
    public function getCustomerName()
    {
        if ($this->currentCustomer->getCustomerId() != 0) { return $this->currentCustomer->getCustomer()->getLastname(); }
    }


    /**
     * @return mixed|void
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getERPCustomerNumber(){
        $customerId  = $this->currentCustomer->getCustomer()->getId();
        $customer = $this->customerRepository->getById($customerId);
        if ($this->currentCustomer->getCustomerId() != 0) { return $customer->getCustomAttribute('nav_customer_no')->getValue(); }
    }

    /**
     * @return mixed|void
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getERPCustomerDiscountGroup(){
        $customerId  = $this->currentCustomer->getCustomer()->getId();
        $customer = $this->customerRepository->getById($customerId);
        if ($this->currentCustomer->getCustomerId() != 0) { return $customer->getCustomAttribute('nav_customer_discount_group')->getValue(); }
    }

    /**
     * @return mixed|void
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getERPCustomerPriceGroup(){
        $customerId  = $this->currentCustomer->getCustomer()->getId();
        $customer = $this->customerRepository->getById($customerId);
        if ($this->currentCustomer->getCustomerId() != 0) { return $customer->getCustomAttribute('nav_customer_price_group')->getValue(); }
    }

    /**
     * @return mixed|void
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getERPCurrencyCode(){
        $customerId  = $this->currentCustomer->getCustomer()->getId();
        $customer = $this->customerRepository->getById($customerId);
        if ($this->currentCustomer->getCustomerId() != 0) { return $customer->getCustomAttribute('nav_currency_code')->getValue(); }
    }
}