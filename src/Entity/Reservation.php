<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $dateStart = null;

    #[ORM\Column]
    private ?\DateTime $dateEnd = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Refuge $refuge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStart(): ?\DateTime
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTime $dateStart = null): static
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTime
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTime $dateEnd = null): static
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getRefuge(): ?Refuge
    {
        return $this->refuge;
    }

    public function setRefuge(?Refuge $refuge): static
    {
        $this->refuge = $refuge;

        return $this;
    }
}
