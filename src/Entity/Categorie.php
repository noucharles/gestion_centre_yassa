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
 *          "groups"={"categorie_read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"categorie_read", "boisson_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"categorie_read", "boisson_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"categorie_read", "boisson_read"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Boisson", mappedBy="categorie")
     * @Groups({"categorie_read"})
     */
    private $boisson;

    public function __construct()
    {
        $this->boisson = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Boisson[]
     */
    public function getBoisson(): Collection
    {
        return $this->boisson;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boisson->contains($boisson)) {
            $this->boisson[] = $boisson;
            $boisson->setCategorie($this);
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        if ($this->boisson->contains($boisson)) {
            $this->boisson->removeElement($boisson);
            // set the owning side to null (unless already changed)
            if ($boisson->getCategorie() === $this) {
                $boisson->setCategorie(null);
            }
        }

        return $this;
    }
}
