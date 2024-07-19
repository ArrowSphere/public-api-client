<?php

namespace ArrowSphere\PublicApiClient\Entities;

use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use DateTimeInterface;
use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity implements JsonSerializable
{
    private const ALLOWED_TYPES = [
        'array',
        'object',
    ];

    private const SCALAR_TYPES = [
        'int',
        'float',
        'bool',
        'string',
    ];

    /**
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        $reflectionClass = new ReflectionClass(static::class);
        $properties = $reflectionClass->getProperties();

        $errors = [];

        foreach ($properties as $property) {
            $attribute = $this->findPropertyAttribute($property);

            if (empty($attribute)) {
                continue;
            }
            $property->setAccessible(true);
            $name = $attribute->name ?? $property->getName();
            $type = $attribute->type;

            if (! isset($data[$name]) ||
                (is_array($data[$name]) && count($data[$name]) === 0)
            ) {
                if ($attribute->required) {
                    $errors[] = sprintf('Missing field: %s', $name);
                }

                continue;
            }

            if (in_array($type, self::ALLOWED_TYPES)) {
                $getValue = static fn ($value) => $value;
            } elseif (in_array($type, self::SCALAR_TYPES)) {
                $getValue = static function ($value) use ($type, $name, $attribute) {
                    if (! $attribute->isArray && ! is_scalar($value)) {
                        throw new EntitiesException(
                            sprintf(
                                'Invalid value for scalar field %s: type %s instead of %s',
                                $name,
                                gettype($value),
                                $type
                            )
                        );
                    }

                    return $value;
                };
            } elseif (class_exists($type)) {
                $getValue = static function ($value) use ($type) {
                    $data = $value;

                    if ($value instanceof JsonSerializable) {
                        $data = $value->jsonSerialize();
                    }

                    return new $type($data);
                };
            } else {
                $errors[] = sprintf('Missing class: %s', $type);

                continue;
            }

            if ($attribute->isArray) {
                $property->setValue($this, array_map(static fn ($value) => $getValue($value), $data[$name]));
            } else {
                $property->setValue($this, $getValue($data[$name]));
            }
        }

        if (! empty($errors)) {
            throw new EntitiesException(static::class . ': ' . implode(', ', $errors));
        }
    }

    public function findPropertyAttribute(ReflectionProperty $property): ?Property
    {
        $attributes = $property->getAttributes();

        foreach ($attributes as $attribute) {

            $newInstance = $attribute->newInstance();
            if ($newInstance instanceof Property) {
                return $newInstance;
            }
        }

        return null;
    }

    public function jsonSerialize(): array
    {
        $fields = [];

        $reflectionClass = new ReflectionClass(static::class);
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $attribute = $this->findPropertyAttribute($property);

            if (! $attribute instanceof Property) {
                continue;
            }
            $name = $attribute->name ?? $property->getName();

            $property->setAccessible(true);

            if ($attribute->required !== false || $property->getValue($this) !== null) {
                $fields[$name] = $property->getValue($this);
                if ($fields[$name] instanceof JsonSerializable) {
                    $fields[$name] = $fields[$name]->jsonSerialize();
                } elseif ($fields[$name] instanceof DateTimeInterface) {
                    $fields[$name] = $fields[$name]->format(DateTimeInterface::ATOM);
                } elseif (is_array($fields[$name])) {
                    $fields[$name] = array_map(static function ($value) {
                        if ($value instanceof JsonSerializable) {
                            return $value->jsonSerialize();
                        }

                        return $value;
                    }, $fields[$name]);
                }
            }
        }

        return $fields;
    }

    public function __call(string $method, array $params): mixed
    {
        $property = lcfirst(substr($method, 3));
        $prefix = substr($method, 0, 3);

        if ($prefix === 'get') {
            return $this->$property;
        }

        if ($prefix === 'set') {
            $this->$property = $params[0];

            return $this;
        }

        return null;
    }
}
