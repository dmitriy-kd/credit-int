<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[Id, GeneratedValue(strategy: 'SEQUENCE'), Column]
    private int $id;

    #[Column(length: 255)]
    private string $fullName;

    #[Column]
    private int $age;

    #[Column(length: 255)]
    private string $region;

    #[Column(length: 255, unique: true)]
    private string $pin;

    #[Column(length: 255, unique: true)]
    private string $email;

    #[Column(length: 255, unique: true)]
    private string $phone;

    #[Column]
    private int $score;

    #[Column]
    private int $income;

    public function __construct(
        string $fullName,
        int $age,
        string $region,
        string $pin,
        string $email,
        string $phone,
        int $score,
        int $income
    ) {
        $this->fullName = $fullName;
        $this->age = $age;
        $this->region = $region;
        $this->pin = $pin;
        $this->email = $email;
        $this->phone = $phone;
        $this->score = $score;
        $this->income = $income;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getPin(): string
    {
        return $this->pin;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getIncome(): int
    {
        return $this->income;
    }
}
