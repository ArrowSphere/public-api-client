<?php

namespace ArrowSphere\PublicApiClient\Entities;

use Attribute;

/**
 * Declares an entity field hydrated and serialized by AbstractEntity.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
final class Property
{
    /**
     * Property constructor.
     *
     * @param string|null $name The name of the field in the data, if it differs from the property name
     * @param string $type A scalar type, 'array', 'object', or the class of a nested entity
     * @param bool $isArray Whether the field is a list of values of the given type
     * @param bool $required Whether the field must be present and not null
     * @param bool $serializeNull Whether the field is serialized even when it is null (as null), instead of being omitted
     */
    public function __construct(
        public ?string $name = null,
        public string $type = 'string',
        public bool $isArray = false,
        public bool $required = false,
        public bool $serializeNull = false
    ) {
    }
}
