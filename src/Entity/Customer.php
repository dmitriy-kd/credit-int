<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[Entity(repositoryClass: CustomerRepository::class)]
#[UniqueEntity(fields: 'pin', message: 'There is already a customer with this pin')]
#[UniqueEntity(fields: 'email,', message: 'There is already a customer with this email')]
#[UniqueEntity(fields: 'phone', message: 'There is already a customer with this phone')]
class Customer
{
    #[Id, GeneratedValue, Column]
    private int $id;

    #[Column(length: 255)]
    private string $fullName;

    #[Column]
    private int $age;

    #[Column(length: 255)]
    private string $city;

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

    public function __construct(
        string $fullName,
        int $age,
        string $city,
        string $region,
        string $pin,
        string $email,
        string $phone,
        int $score
    ) {
        $this->fullName = $fullName;
        $this->age = $age;
        $this->city = $city;
        $this->region = $region;
        $this->pin = $pin;
        $this->email = $email;
        $this->phone = $phone;
        $this->score = $score;
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

    public function getCity(): string
    {
        return $this->city;
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
}
