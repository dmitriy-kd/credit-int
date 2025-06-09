<?php

namespace App\Dto\Loan;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Sequentially;
use Symfony\Component\Validator\Constraints\Type;

class LoanDto
{
    #[Sequentially([
        new NotBlank(),
        new Type('integer'),
        new Range(min: 0, max: 100000)
    ])]
    public int $amount;

    #[Sequentially([
        new NotBlank(),
        new Type('integer'),
        new Range(min: 5, max: 30)
    ])]
    public int $creditTimeInDays;
}
