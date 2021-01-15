<?php

namespace ArrowSphere\PublicApiClient;

use ReflectionClass;

abstract class AbstractEnum {
    private static $constCacheArray = [];

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    private static function getConstants()
    {
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    /**
     * @param string $name
     * @param bool $strict
     * @return bool
     * @throws \ReflectionException
     */
    public static function isValidName(string $name, bool $strict = false) : bool
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        return in_array(strtolower($name), array_keys(array_change_key_case($constants)));
    }

    /**
     * @param $value
     * @param bool $strict
     * @return bool
     * @throws \ReflectionException
     */
    public static function isValidValue($value, bool $strict = true) : bool
    {
        $values = array_values(self::getConstants());

        return in_array($value, $values, $strict);
    }
}
