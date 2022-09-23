<?php

namespace App\Entity\Trait;

use Doctrine\Orm\Mapping as ORM;

trait CreatedAtTrait
{
    

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

}