<?php

namespace App\Service\Loan\IssueChecker;

use App\Entity\Customer;
use App\ValueObject\Loan\IssueCheckerResult;

readonly class AgeChecker implements IssueCheckerInterface
{
    public function __construct(private int $minAge, private int $maxAge) {}

    public function isReadyToIssue(Customer $customer): IssueCheckerResult
    {
        $isReady = $customer->getAge() >= $this->minAge && $customer->getAge() <= $this->maxAge;

        return new IssueCheckerResult($isReady, $isReady ? '' : 'Customer age is not fit');
    }

    public static function getPriority(): int
    {
        return 80;
    }
}
