<?php

namespace App\Controller\Loan;

use App\Dto\Loan\LoanDto;
use App\Entity\Customer;
use App\Service\Loan\LoanManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class LoanController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly LoanManager $loanManager
    ) {}

    #[Route(
        '/api/loan/issue/{id}',
        name: 'api_loan_issue',
        methods: ['POST']
    )]
    public function issue(
        Customer $customer,
        #[MapRequestPayload] LoanDto $loanDto
    ): Response {
        try {
            $this->loanManager->issueLoan($customer, $loanDto);

            return new JsonResponse();
        } catch (UniqueConstraintViolationException) {
            return new JsonResponse(['This customer already have not closed loan']);
        } catch (Throwable $e) {
            $this->logger->critical($e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return new JsonResponse(
                ['Unexpected error occurred, please try again later'],
                status: Response::HTTP_BAD_REQUEST
            );
        }
    }

    #[Route(
        '/api/loan/customer/{id}',
        name: 'api_loan_active_customer',
        methods: ['GET']
    )]
    public function getCustomerActiveLoan(Customer $customer): Response
    {
        try {
            $loan = $this->loanManager->getCustomerActiveLoan($customer);

            if ($loan === null) {
                return new JsonResponse(status: Response::HTTP_NOT_FOUND);
            }

            return $this->json($loan);
        } catch (Throwable $e) {
            $this->logger->critical($e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return new JsonResponse(
                ['Unexpected error occurred, please try again later'],
                status: Response::HTTP_BAD_REQUEST
            );
        }
    }
}
