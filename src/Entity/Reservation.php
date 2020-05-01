<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateReservation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reservationSalle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reservationTable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="reservations")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getReservationSalle(): ?int
    {
        return $this->reservationSalle;
    }

    public function setReservationSalle(?int $reservationSalle): self
    {
        $this->reservationSalle = $reservationSalle;

        return $this;
    }

    public function getReservationTable(): ?int
    {
        return $this->reservationTable;
    }

    public function setReservationTable(?int $reservationTable): self
    {
        $this->reservationTable = $reservationTable;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
