<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Quote", mappedBy="categorie")
     */
    private $Quotes;

    public function __construct()
    {
        $this->Quotes = new ArrayCollection();
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

    /**
     * @return Collection|Quote[]
     */
    public function getQuotes(): Collection
    {
        return $this->Quotes;
    }

    public function addQuote(Quote $quote): self
    {
        if (!$this->Quotes->contains($quote)) {
            $this->Quotes[] = $quote;
            $quote->setCategorie($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->Quotes->contains($quote)) {
            $this->Quotes->removeElement($quote);
            // set the owning side to null (unless already changed)
            if ($quote->getCategorie() === $this) {
                $quote->setCategorie(null);
            }
        }

        return $this;
    }
}
