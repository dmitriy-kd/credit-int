<?php

namespace App\Dto\Customer;

use App\Entity\Customer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Sequentially;
use Symfony\Component\Validator\Constraints\Type;

#[UniqueEntity(fields: 'pin', message: 'There is already a customer with this pin', entityClass: Customer::class)]
#[UniqueEntity(fields: 'email', message: 'There is already a customer with this email', entityClass: Customer::class)]
#[UniqueEntity(fields: 'phone', message: 'There is already a customer with this phone', entityClass: Customer::class)]
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
        new Range(min: 0, max: 120)
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
        new Regex('/^[+]\d+/'),
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
