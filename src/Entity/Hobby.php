<?php

namespace App\Entity;

use App\Repository\HobbyRepository;
use App\Trait\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Entity(repositoryClass: HobbyRepository::class),
    ORM\HasLifecycleCallbacks()
]
class Hobby
{
    use TimeStampTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $designation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }
}
