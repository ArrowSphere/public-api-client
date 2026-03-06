<?php

namespace ArrowSphere\PublicApiClient\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class CustomField extends AbstractEntity
{
    public const COLUMN_LABEL = 'label';
    public const COLUMN_VALUE = 'value';

    #[Property(required: true)]
    protected string $label;

    #[Property(name: 'value')]
    protected string $value;
}
