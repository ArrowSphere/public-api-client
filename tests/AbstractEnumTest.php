<?php

namespace ArrowSphere\PublicApiClient\Tests;

use ArrowSphere\PublicApiClient\AbstractEnum;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractEnumTest
 */
class AbstractEnumTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetFilters()
    {
        self::assertFalse(DaysOfWeek::isValidName('Humpday'));
        self::assertTrue(DaysOfWeek::isValidName('Monday'));
        self::assertFalse(DaysOfWeek::isValidName('monday', true));

        self::assertTrue(DaysOfWeek::isValidValue(0));
        self::assertFalse(DaysOfWeek::isValidValue(7));
        self::assertFalse(DaysOfWeek::isValidValue('Friday'));
    }
}

abstract class DaysOfWeek extends AbstractEnum
{
    public const SUNDAY = 0;
    public const MONDAY = 1;
    public const TUESDAY = 2;
    public const WEDNESDAY = 3;
    public const THURSDAY = 4;
    public const FRIDAY = 5;
    public const SATERDAY = 6;
}
