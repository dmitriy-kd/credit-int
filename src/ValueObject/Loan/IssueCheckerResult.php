<?php

namespace App\ValueObject\Loan;

final readonly class IssueCheckerResult
{
    public function __construct(
        private bool $ready,
        private string $error
    ) {}

    public function isReady(): bool
    {
        return $this->ready;
    }

    public function getError(): string
    {
        return $this->error;
    }
}
