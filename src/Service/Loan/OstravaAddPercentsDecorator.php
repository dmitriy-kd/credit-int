<?php

namespace App\Service\Loan;

use App\Entity\Customer;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(LoanManager::class)]
class OstravaAddPercentsDecorator extends LoanManager
{
    public function getInterest(Customer $customer): float
    {
        if ($customer->getRegion() === 'OS') {
            return parent::getInterest($customer) + 5;
        }

        return parent::getInterest($customer);
    }
}
