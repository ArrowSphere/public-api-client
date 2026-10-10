<?php

namespace ArrowSphere\PublicApiClient\Tests\Entities\Fixtures;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class SampleChild extends AbstractEntity
{
    #[Property(required: true)]
    protected string $name;
}
