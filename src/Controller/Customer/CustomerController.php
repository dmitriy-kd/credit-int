<?php

namespace App\Controller\Customer;

use App\Dto\Customer\CustomerDto;
use App\Service\Customer\CustomerManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class CustomerController extends AbstractController
{
    public function __construct(
        private readonly CustomerManager $customerManager,
        private readonly LoggerInterface $logger
    ) {}

    #[Route(
        '/api/customer',
        name: 'api_customer_create',
        methods: ['POST']
    )]
    public function create(
        #[MapRequestPayload] CustomerDto $customerDto
    ): Response {
        try {
            $customer = $this->customerManager->createCustomer($customerDto);

            return new JsonResponse($customer);
        } catch (Throwable $e) {
            $this->logger->critical($e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return new JsonResponse(
                ['error' => 'Unexpected error occurred, please try again later'],
                status: Response::HTTP_BAD_REQUEST
            );
        }
    }
}
