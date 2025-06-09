<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\UniqueConstraint;

#[Entity(repositoryClass: LoanRepository::class)]
#[UniqueConstraint(columns: ['customer_id'], options: ['where' => 'closed_at IS NULL'])]
class Loan
{
    #[Id, GeneratedValue(strategy: 'SEQUENCE'), Column]
    private int $id;

    #[Column(length: 255)]
    private string $name;

    #[Column]
    private int $creditTimeInDays;

    #[Column]
    private float $interest;

    #[Column]
    private int $body;

    #[Column]
    private DateTimeImmutable $createdAt;

    #[Column(nullable: true)]
    private ?DateTimeImmutable $closedAt = null;

    #[ManyToOne(targetEntity: Customer::class)]
    private Customer $customer;

    public function __construct(
        Customer $customer,
        string $name,
        int $creditTimeInDays,
        float $interest,
        int $body
    ) {
        $this->customer = $customer;
        $this->name = $name;
        $this->creditTimeInDays = $creditTimeInDays;
        $this->interest = $interest;
        $this->body = $body;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreditTimeInDays(): int
    {
        return $this->creditTimeInDays;
    }

    public function getInterest(): float
    {
        return $this->interest;
    }

    public function getBody(): int
    {
        return $this->body;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getClosedAt(): ?DateTimeImmutable
    {
        return $this->closedAt;
    }

    public function setClosedAt(DateTimeImmutable $dateTime): self
    {
        $this->closedAt = $dateTime;

        return $this;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
