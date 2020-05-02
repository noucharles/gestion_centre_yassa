<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups"={"commande_read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"commande_read", "boisson_read", "user_read", "menu_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"commande_read", "boisson_read", "user_read", "menu_read"})
     */
    private $dateCommande;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"commande_read", "boisson_read", "user_read", "menu_read"})
     */
    private $numTable;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Menu", inversedBy="commandes")
     * @Groups({"commande_read","boisson_read", "user_read"})
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commande")
     * @Groups({"commande_read","boisson_read", "menu_read"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Boisson", mappedBy="commande")
     * @Groups({"commande_read", "user_read", "menu_read"})
     */
    private $boissons;

    public function __construct()
    {
        $this->menu = new ArrayCollection();
        $this->boissons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getNumTable(): ?int
    {
        return $this->numTable;
    }

    public function setNumTable(int $numTable): self
    {
        $this->numTable = $numTable;

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menu->contains($menu)) {
            $this->menu->removeElement($menu);
        }

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
     * @return Collection|Boisson[]
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
            $boisson->addCommande($this);
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        if ($this->boissons->contains($boisson)) {
            $this->boissons->removeElement($boisson);
            $boisson->removeCommande($this);
        }

        return $this;
    }
}
