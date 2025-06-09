<?php

namespace App\Service\Loan\IssueChecker;

use App\Entity\Customer;
use App\ValueObject\Loan\IssueCheckerResult;

readonly class RegionChecker implements IssueCheckerInterface
{
    public function __construct(private array $approvedRegions) {}

    public function isReadyToIssue(Customer $customer): IssueCheckerResult
    {
        $isReady = in_array($customer->getRegion(), $this->approvedRegions, true);

        return new IssueCheckerResult($isReady, $isReady ? '' : 'Customer region is not approved');
    }

    public static function getPriority(): int
    {
        return 70;
    }
}
