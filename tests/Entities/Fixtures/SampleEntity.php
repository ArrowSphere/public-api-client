<?php

namespace ArrowSphere\PublicApiClient\Tests\Entities\Fixtures;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;
use DateTimeImmutable;

class SampleEntity extends AbstractEntity
{
    #[Property]
    protected ?string $label = null;

    #[Property(name: 'external_id', type: 'int', required: true)]
    protected int $externalId;

    #[Property(type: 'array')]
    protected ?array $tags = null;

    #[Property(isArray: true)]
    protected ?array $aliases = null;

    #[Property(type: SampleChild::class)]
    protected ?SampleChild $child = null;

    #[Property(type: SampleChild::class, isArray: true)]
    protected ?array $children = null;

    #[Property(type: DateTimeImmutable::class)]
    protected ?DateTimeImmutable $createdAt = null;

    protected string $notMapped = 'internal';
}
