<?php

declare(strict_types=1);

namespace App\Entity;

use App\Form\Type\MovieType;
use App\Grid\MovieGrid;
use App\Processor\MovieArchiveProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Show;
use Sylius\Resource\Metadata\Update;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints as Constraints;

#[AsResource(
    section: 'admin',
    formType: MovieType::class,
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Create(),
        new Create(
            shortName: 'duplicate',
            path: 'movies/{id}/duplicate',
            template: '@SyliusAdminUi/crud/create.html.twig',
            factoryMethod: 'createFromMovie',
            factoryArguments: ['request.attributes.get("id")'],
        ),
        new Index(grid: MovieGrid::class),
        new Show(),
        new Update(),
        new Delete(processor: MovieArchiveProcessor::class),
    ],
)]
#[ORM\Entity]
class Movie implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    public bool $archived = false;

    #[Constraints\NotBlank]
    #[ORM\Column(length: 180)]
    public string $title = '';

    #[Constraints\NotBlank]
    #[ORM\Column(type: 'date_immutable')]
    public \DateTimeImmutable $releaseDate;

    /** @var Collection<int, Actor> $actors */
    #[Constraints\Valid]
    #[ORM\OneToMany(
        targetEntity: Actor::class,
        mappedBy: 'movie',
        cascade: ['persist', 'remove'],
        orphanRemoval: true,
    )]
    public Collection $actors;

    public function __construct(
    ) {
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
            $actor->movie = $this;
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }
}
