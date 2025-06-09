<?php

namespace App\Service\Loan\IssueChecker;

use App\Entity\Customer;
use App\ValueObject\Loan\IssueCheckerResult;

class PragueChecker implements IssueCheckerInterface
{
    public function isReadyToIssue(Customer $customer): IssueCheckerResult
    {
        $declined = false;

        if ($customer->getRegion() === 'PR') {
            $declined = (rand(1, 21) % 3) === 0;
        }

        return new IssueCheckerResult(!$declined, !$declined ? '' : 'Customer region is not approved');
    }

    public static function getPriority(): int
    {
        return 60;
    }
}
