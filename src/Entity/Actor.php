<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Constraints;

#[ORM\Entity]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Movie::class, cascade: ['persist'], inversedBy: 'actors')]
    #[ORM\JoinColumn(nullable: false)]
    public Movie $movie;

    #[Constraints\NotBlank]
    #[ORM\Column(length: 180)]
    public string $name = '';
}
