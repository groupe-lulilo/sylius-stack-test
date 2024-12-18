<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Actor;
use App\Entity\Movie;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Resource\Factory\FactoryInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(decorates: 'app.factory.movie')]
final class MovieFactory implements FactoryInterface
{
    public function __construct(
        private FactoryInterface $baseFactory,
        private EntityRepository $movieRepository,
    ) {
    }

    public function createNew(): Movie
    {
        return $this->baseFactory->createNew();
    }

    public function createFromMovie(string $id): Movie
    {
        $old = $this->movieRepository->findOneBy(['id' => $id]);

        $new = $this->baseFactory->createNew();
        $new->title = $old->title;
        $new->releaseDate = $old->releaseDate;
        foreach ($old->actors as $oldActor) {
            $newActor = new Actor();
            $newActor->name = $oldActor->name;
            $new->addActor($newActor);
        }

        return $new;
    }
}
