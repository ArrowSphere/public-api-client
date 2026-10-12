<?php

namespace ArrowSphere\PublicApiClient\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * Class AbstractEntityTest
 */
abstract class AbstractEntityTest extends TestCase
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
     * @param string $expected
     */
    public function testSerialization(array $fields, string $expected): void
    {
        $entity = $this->createEntity($fields);

        // The order of the keys is not significant
        self::assertJsonStringEqualsJsonString($expected, (string) json_encode($entity));
    }

    /**
     * Calls every getter of the entity, so that a getter which cannot return the value the entity holds fails.
     *
     * @dataProvider providerSerialization
     *
     * @param array $fields
     * @param string $expected
     */
    public function testGetters(array $fields, string $expected): void
    {
        self::callGetters($this->createEntity($fields), $this);
    }

    /**
     * Builds the entity under test; override it when the entity needs more than its data.
     *
     * @param array $fields
     *
     * @return object
     */
    protected function createEntity(array $fields): object
    {
        $className = static::CLASS_NAME;
        if ($className === null) {
            self::fail('The const CLASS_NAME must be redefined in ' . static::class);
        }

        return new $className($fields);
    }

    /**
     * Calls every public method of the entity whose name starts with get or is and which needs no argument.
     *
     * @param object $entity
     * @param TestCase $test
     */
    public static function callGetters(object $entity, TestCase $test): void
    {
        $getters = array_filter(get_class_methods($entity), static function (string $method) use ($entity): bool {
            return preg_match('/^(get|is)[A-Z]/', $method) === 1
                && (new ReflectionMethod($entity, $method))->getNumberOfRequiredParameters() === 0;
        });

        if ($getters === []) {
            $test->expectNotToPerformAssertions();

            return;
        }

        foreach ($getters as $getter) {
            $entity->$getter();
            $test->addToAssertionCount(1);
        }
    }
}
