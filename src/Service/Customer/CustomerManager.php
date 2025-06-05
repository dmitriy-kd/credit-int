<?php

namespace App\Service\Customer;

use App\Dto\Customer\CustomerDto;
use App\Entity\Customer;
use App\Repository\CustomerRepository;

readonly class CustomerManager
{
    public function __construct(private CustomerRepository $customerRepository) {}

    public function createCustomer(CustomerDto $customerDto): Customer
    {
        $customer = new Customer(
            $customerDto->fullName,
            $customerDto->age,
            $customerDto->region,
            $customerDto->pin,
            $customerDto->email,
            $customerDto->phone,
            $customerDto->score,
            $customerDto->income
        );

        $this->customerRepository->save($customer);

        return $customer;
    }
}
