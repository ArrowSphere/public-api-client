<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Attribute;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

/**
 * Class AttributeTest
 */
class AttributeTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testAttributeWithValue(): void
    {
        $attribute = new Attribute([
            'name'  => 'color',
            'value' => 'blue',
        ]);

        self::assertSame('color', $attribute->getName());
        self::assertSame('blue', $attribute->getValue());
    }

    /**
     * @throws EntityValidationException
     */
    public function testAttributeWithNullValue(): void
    {
        $attribute = new Attribute([
            'name'  => 'color',
            'value' => null,
        ]);

        self::assertSame('color', $attribute->getName());
        self::assertNull($attribute->jsonSerialize()['value']);
    }

    /**
     * @throws EntityValidationException
     */
    public function testAttributeWithMissingValue(): void
    {
        $attribute = new Attribute([
            'name' => 'color',
        ]);

        self::assertSame('color', $attribute->getName());
        self::assertNull($attribute->jsonSerialize()['value']);
    }

    /**
     * @throws EntityValidationException
     */
    public function testAttributeSerializesWithValue(): void
    {
        $attribute = new Attribute([
            'name'  => 'color',
            'value' => 'blue',
        ]);

        $serialized = $attribute->jsonSerialize();

        self::assertSame([
            'name'  => 'color',
            'value' => 'blue',
        ], $serialized);
    }

    /**
     * @throws EntityValidationException
     */
    public function testAttributeSerializesWithNullValue(): void
    {
        $attribute = new Attribute([
            'name'  => 'color',
            'value' => null,
        ]);

        $serialized = $attribute->jsonSerialize();

        self::assertSame('color', $serialized['name']);
        self::assertNull($serialized['value']);
    }
}
