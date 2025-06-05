<?php

namespace App\Dto\Customer;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Sequentially;
use Symfony\Component\Validator\Constraints\Type;

class CustomerDto
{
    #[Sequentially([
        new NotBlank(),
        new Type('string'),
        new Length(max: 255)
    ])]
    public string $fullName;

    #[Sequentially([
        new NotBlank(),
        new Type('integer'),
        new Range(min: 21, max: 60)
    ])]
    public int $age;

    #[Sequentially([
        new NotBlank(),
        new Type('string'),
        new Length(exactly: 2)
    ])]
    public string $region;

    #[Sequentially([
        new NotBlank(),
        new Type('string'),
        new Length(max: 255)
    ])]
    public string $pin;

    #[Sequentially([
        new NotBlank(),
        new Type('integer'),
        new Range(min: 0, max: 1000)
    ])]
    public int $score;

    #[Sequentially([
        new NotBlank(),
        new Email()
    ])]
    public string $email;

    #[Sequentially([
        new NotBlank(),
        new Type('string'),
        new Regex('|^+\d+|'),
        new Length(min: 8, max: 14)
    ])]
    public string $phone;

    #[Sequentially([
        new NotBlank(),
        new Type('integer'),
        new Range(min: 0, max: 2147483646)
    ])]
    public int $income;
}
