<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={"client_read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"client_read", "reservation_read", "formation_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client_read", "reservation_read", "formation_read"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client_read", "reservation_read", "formation_read"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"client_read"})
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"client_read", "reservation_read", "formation_read"})
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Formation", inversedBy="clients")
     * @Groups({"client_read", "reservation_read"})
     */
    private $formation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="client")
     * @Groups({"client_read", "formation_read"})
     */
    private $reservations;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation[] = $formation;
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formation->contains($formation)) {
            $this->formation->removeElement($formation);
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setClient($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getClient() === $this) {
                $reservation->setClient(null);
            }
        }

        return $this;
    }
}
