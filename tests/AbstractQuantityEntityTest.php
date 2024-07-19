<?php

namespace ArrowSphere\PublicApiClient\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractEntityTest
 */
abstract class AbstractQuantityEntityTest extends TestCase
{
    /**
     * The name of the entity class that needs to be tested here
     */
    protected const CLASS_NAME = null;

    /**
     * This is a generic provider that must return test cases with the following arguments:
     * - fields: an array containing the fields provided to the entity
     * - expected: a string containing the expected JSON (pretty-printed for readability)
     *
     * @return array
     */
    abstract public function providerSerialization(): array;

    /**
     * @dataProvider providerSerialization
     *
     * @param array $fields
     * @param int $quantity
     * @param string $expected
     */
    public function testSerialization(array $fields, int $quantity, string $expected): void
    {
        $className = static::CLASS_NAME;
        if ($className === null) {
            self::fail('The const CLASS_NAME must be redefined in ' . static::class);
        }

        $activeSeats = new $className($fields, $quantity);

        self::assertSame($expected, json_encode($activeSeats, JSON_PRETTY_PRINT));
    }
}
