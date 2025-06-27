<?php

namespace App\Trait;
use Doctrine\ORM\Mapping as ORM;
trait TimeStampTrait
{

    #[ORM\Column]
    private \DateTime $createdAt;
    #[ORM\Column()]
    private \DateTime $updatedAt;


    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    #[ORM\PrePersist()]
    public function onPrePersist(): void
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    #[ORM\PreUpdate()]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }


}