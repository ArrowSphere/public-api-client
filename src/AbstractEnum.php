<?php

namespace ArrowSphere\PublicApiClient;

use ReflectionClass;
use ReflectionException;

abstract class AbstractEnum
{
    /**
     * @var array<string, array<string, int|string>>
     */
    private static $constCacheArray = [];

    /**
     * @return array<string, int|string>
     */
    private static function getConstants(): array
    {
        $calledClass = static::class;
        if (! array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            /** @var array<string, int|string> $constants the values of an enum are strings or integers */
            $constants = $reflect->getConstants();
            self::$constCacheArray[$calledClass] = $constants;
        }

        return self::$constCacheArray[$calledClass];
    }

    /**
     * @param string $name
     * @param bool $strict
     *
     * @return bool
     */
    public static function isValidName(string $name, bool $strict = false) : bool
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        return array_key_exists(strtolower($name), array_change_key_case($constants));
    }

    /**
     * @param mixed $value
     * @param bool $strict
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    public static function isValidValue($value, bool $strict = true) : bool
    {
        $values = array_values(self::getConstants());

        return in_array($value, $values, $strict);
    }

    /**
     * @param array<int|string> $values
     *
     * @return array<int|string>
     *
     * @throws ReflectionException
     */
    public static function invalidValues(array $values): array
    {
        $enumValues = array_values(self::getConstants());

        return array_diff($values, $enumValues);
    }
}
