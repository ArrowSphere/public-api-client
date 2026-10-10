<?php

namespace ArrowSphere\PublicApiClient\Tests\Entities\Fixtures;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class UnknownTypeEntity extends AbstractEntity
{
    #[Property(type: 'ArrowSphere\PublicApiClient\Tests\Entities\Fixtures\DoesNotExist')]
    protected $thing;
}
