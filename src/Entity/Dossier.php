<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use App\Trait\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DossierRepository::class),
    ORM\HasLifecycleCallbacks()]
class Dossier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    use TimeStampTrait;
    #[ORM\Column(length: 12)]
    private ?string $refrence = null;

    #[ORM\Column]
    private ?\DateTime $creationDate = null;

    #[ORM\Column(length: 1)]
    private ?string $status = null;

    #[ORM\OneToOne(inversedBy: 'dossier', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Person $Person = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?City $city = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gouvernorat $gouvernorat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefrence(): ?string
    {
        return $this->refrence;
    }

    public function setRefrence(string $refrence): static
    {
        $this->refrence = $refrence;

        return $this;
    }

    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->Person;
    }

    public function setPerson(Person $Person): static
    {
        $this->Person = $Person;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getGouvernorat(): ?Gouvernorat
    {
        return $this->gouvernorat;
    }

    public function setGouvernorat(?Gouvernorat $gouvernorat): static
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }
}
