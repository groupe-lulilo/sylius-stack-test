<?php

declare(strict_types=1);

namespace App\Processor;

use Doctrine\ORM\EntityManagerInterface;
use Sylius\Resource\Context\Context;
use Sylius\Resource\Metadata\Operation;
use Sylius\Resource\State\ProcessorInterface;

final class MovieArchiveProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function process(mixed $data, Operation $operation, Context $context): mixed
    {
        $data->archived = true;

        $this->em->flush();

        return null;
    }
}
