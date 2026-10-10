<?php

namespace ArrowSphere\PublicApiClient\Tests\Entities\Fixtures;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class SerializeNullEntity extends AbstractEntity
{
    #[Property(required: true)]
    protected string $reference;

    #[Property(serializeNull: true)]
    protected ?string $headcount = null;

    #[Property]
    protected ?string $comment = null;
}
