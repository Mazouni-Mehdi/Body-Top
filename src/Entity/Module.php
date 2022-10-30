<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $planning = null;

    #[ORM\Column]
    private ?bool $registration = null;

    #[ORM\Column]
    private ?bool $negotiation = null;

    #[ORM\Column]
    private ?bool $sale = null;

    #[ORM\Column]
    private ?bool $advertising = null;

    #[ORM\Column]
    private ?bool $mailing = null;

    #[ORM\Column]
    private ?bool $training = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPlanning(): ?bool
    {
        return $this->planning;
    }

    public function setPlanning(bool $planning): self
    {
        $this->planning = $planning;

        return $this;
    }

    public function isRegistration(): ?bool
    {
        return $this->registration;
    }

    public function setRegistration(bool $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    public function isNegotiation(): ?bool
    {
        return $this->negotiation;
    }

    public function setNegotiation(bool $negotiation): self
    {
        $this->negotiation = $negotiation;

        return $this;
    }

    public function isSale(): ?bool
    {
        return $this->sale;
    }

    public function setSale(bool $sale): self
    {
        $this->sale = $sale;

        return $this;
    }

    public function isAdvertising(): ?bool
    {
        return $this->advertising;
    }

    public function setAdvertising(bool $advertising): self
    {
        $this->advertising = $advertising;

        return $this;
    }

    public function isMailing(): ?bool
    {
        return $this->mailing;
    }

    public function setMailing(bool $mailing): self
    {
        $this->mailing = $mailing;

        return $this;
    }

    public function isTraining(): ?bool
    {
        return $this->training;
    }

    public function setTraining(bool $training): self
    {
        $this->training = $training;

        return $this;
    }
}
