<?php

namespace ArrowSphere\PublicApiClient\Tests\Entities\Fixtures;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class TwoRequiredFieldsEntity extends AbstractEntity
{
    #[Property(required: true)]
    protected string $first;

    #[Property(required: true)]
    protected string $second;
}
