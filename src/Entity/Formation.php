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
 *          "groups"={"formation_read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 */
class Formation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"formation_read", "client_read", "user_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"formation_read", "client_read", "user_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"formation_read", "client_read", "user_read"})
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="formations")
     * @Groups({"formation_read", "client_read"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", mappedBy="formation")
     * @Groups({"formation_read", "user_read"})
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->addFormation($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
            $client->removeFormation($this);
        }

        return $this;
    }
}
