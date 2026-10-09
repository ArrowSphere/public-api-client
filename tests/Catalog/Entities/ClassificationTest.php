<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Classification;
use PHPUnit\Framework\TestCase;

class ClassificationTest extends TestCase
{
    /**
     */
    public function testClassificationSerialisation(): void
    {
        $classification = new Classification([
            "name" => "Microsoft",
        ]);

        self::assertEquals('"Microsoft"', json_encode($classification));
    }
}
