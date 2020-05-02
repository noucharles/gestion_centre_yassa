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
 *          "groups"={"boisson_read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BoissonRepository")
 */
class Boisson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"boisson_read", "categorie_read", "commande_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"boisson_read", "categorie_read", "commande_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"boisson_read", "categorie_read", "commande_read"})
     */
    private $quantite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande", inversedBy="boissons")
     * @Groups({"boisson_read", "categorie_read"})
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="boisson")
     * @Groups({"boisson_read", "commande_read"})
     */
    private $categorie;

    public function __construct()
    {
        $this->commande = new ArrayCollection();
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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->contains($commande)) {
            $this->commande->removeElement($commande);
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
