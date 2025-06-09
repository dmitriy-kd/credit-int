<?php

namespace App\Service\Loan\IssueChecker;

use App\Entity\Customer;
use App\ValueObject\Loan\IssueCheckerResult;

readonly class ScoreChecker implements IssueCheckerInterface
{
    public function __construct(private int $minScore) {}

    public function isReadyToIssue(Customer $customer): IssueCheckerResult
    {
        $isReady = $customer->getScore() > $this->minScore;

        return new IssueCheckerResult($isReady, $isReady ? '' : 'Customer score is less than min');
    }

    public static function getPriority(): int
    {
        return 100;
    }
}
