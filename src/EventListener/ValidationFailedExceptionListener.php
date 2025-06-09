<?php

namespace App\EventListener;

use App\ValueObject\Common\ValidationFailedJsonResponse;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\Exception\ValidationFailedException;

#[AsEventListener]
class ValidationFailedExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!($exception instanceof ValidationFailedException)) {
            $exception = $exception->getPrevious();

            if (!($exception instanceof ValidationFailedException)) {
                return;
            }
        }

        $event->setResponse(new ValidationFailedJsonResponse($exception->getViolations()));
    }
}
