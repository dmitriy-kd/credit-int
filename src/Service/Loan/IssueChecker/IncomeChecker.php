<?php

namespace App\Service\Loan\IssueChecker;

use App\Entity\Customer;
use App\ValueObject\Loan\IssueCheckerResult;

readonly class IncomeChecker implements IssueCheckerInterface
{
    public function __construct(private int $minIncome) {}

    public function isReadyToIssue(Customer $customer): IssueCheckerResult
    {
        $isReady = $customer->getIncome() >= $this->minIncome;

        return new IssueCheckerResult($isReady, $isReady ? '' : 'Customer income is less than min');
    }

    public static function getPriority(): int
    {
        return 90;
    }
}
