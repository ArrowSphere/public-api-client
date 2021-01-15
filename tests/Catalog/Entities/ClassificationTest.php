<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Classification;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class ClassificationTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testClassificationSerialisation(): void
    {
        $classification = new Classification([
            "name" => "Microsoft",
        ]);

        self::assertEquals('"Microsoft"', json_encode($classification));
    }
}