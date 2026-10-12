<?php

namespace ArrowSphere\PublicApiClient\Orders\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class CustomField extends AbstractEntity
{
    public const COLUMN_LABEL = 'label';
    public const COLUMN_VALUE = 'value';

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $label;

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $value;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
