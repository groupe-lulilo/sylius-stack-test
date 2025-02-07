<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Show;
use Sylius\Resource\Metadata\Update;
use Sylius\Component\Resource\Model\ResourceInterface;
use App\Grid\BrandGrid;
use App\Form\Type\BrandType;

#[AsResource(
    section: 'admin',
    formType: BrandType::class,
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Create(),
        new Index(grid: BrandGrid::class),
        new Show(),
        new Update(),
        new Delete(),
    ],
)]
#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? ''; // Retourne le titre de la catégorie
    }

}
