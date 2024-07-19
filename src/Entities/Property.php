<?php

namespace ArrowSphere\PublicApiClient\Entities;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class Property
{
    public function __construct(public ?string $name = null, public string $type = 'string', public bool $isArray = false, public bool $required = false)
    {
    }
}
