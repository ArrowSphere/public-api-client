<?php

namespace ArrowSphere\PublicApiClient;

use ReflectionClass;
use ReflectionException;

abstract class AbstractEnum
{
    /**
     * @var array
     */
    private static $constCacheArray = [];

    private static function getConstants(): array
    {
        $calledClass = static::class;
        if (! array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
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
     * @param array $values
     *
     * @return array
     *
     * @throws ReflectionException
     */
    public static function invalidValues(array $values): array
    {
        $enumValues = array_values(self::getConstants());

        return array_diff($values, $enumValues);
    }
}
