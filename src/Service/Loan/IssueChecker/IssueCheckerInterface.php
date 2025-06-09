<?php

namespace App\Service\Loan\IssueChecker;

use App\Entity\Customer;
use App\ValueObject\Loan\IssueCheckerResult;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.loan.issue_checker')]
interface IssueCheckerInterface
{
    public function isReadyToIssue(Customer $customer): IssueCheckerResult;
    public static function getPriority(): int;
}
