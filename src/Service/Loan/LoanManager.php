<?php

namespace App\Service\Loan;

use App\Dto\Loan\LoanDto;
use App\Entity\Customer;
use App\Entity\Loan;
use App\Repository\LoanRepository;
use App\Service\Loan\IssueChecker\IssueCheckerInterface;
use DateTimeImmutable;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class LoanManager
{
    private iterable $loanIssueCheckers;

    public function __construct(
        #[AutowireIterator('app.loan.issue_checker', defaultPriorityMethod: 'getPriority')]
        iterable $loanIssueCheckers,
        private readonly LoggerInterface $logger,
        private readonly LoanRepository $loanRepository
    ) {
        $this->loanIssueCheckers = $loanIssueCheckers;
    }

    public function issueLoan(Customer $customer, LoanDto $loanDto): void
    {
        foreach ($this->loanIssueCheckers as $checker) {
            /** @var IssueCheckerInterface $checker */
            $result = $checker->isReadyToIssue($customer);

            if ($result->isReady() === false) {
                $this->notifyCustomer($customer->getFullName(), false);

                return;
            }
        }

        $loan = new Loan(
            $customer,
            "{$customer->getFullName()} {$customer->getEmail()}",
            $loanDto->creditTimeInDays,
            $this->getInterest($customer),
            $loanDto->amount
        );

        $this->loanRepository->save($loan);

        $this->notifyCustomer($customer->getFullName(), true);
    }

    private function notifyCustomer(string $customerName, bool $isIssued): void
    {
        $this->logger->notice(sprintf(
            '[%s] Notification to customer [%s]: Loan was %s',
            (new DateTimeImmutable())->format('Y-m-d H:i:s'),
            $customerName,
            $isIssued ? 'issued' : 'declined'
        ));
    }

    public function getInterest(Customer $customer): float
    {
        return 10;
    }

    public function getCustomerActiveLoan(Customer $customer): ?Loan
    {
        return $this->loanRepository->findOneBy([
            'customer' => $customer,
            'closedAt' => null
        ]);
    }
}
