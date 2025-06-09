<?php

namespace App\ValueObject\Common;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationFailedJsonResponse extends JsonResponse
{
    public function __construct(ConstraintViolationListInterface $violationList)
    {
        $errors = [];

        foreach ($violationList as $violation) {
            $errors[] = $violation->getMessage();
        }

        parent::__construct($errors, self::HTTP_BAD_REQUEST);
    }
}
