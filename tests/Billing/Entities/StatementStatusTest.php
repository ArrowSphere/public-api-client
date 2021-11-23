<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing\Entities;

use ArrowSphere\PublicApiClient\Billing\Entities\StatementStatus;
use ArrowSphere\PublicApiClient\Tests\AbstractEntityTest;

/**
 * Class StatementStatusTest
 */
class StatementStatusTest extends AbstractEntityTest
{
    protected const CLASS_NAME = StatementStatus::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields' => [
                    'creationDate' => '2020-01-01',
                    'submissionDate' => '2020-01-02',
                    'validationDate' => '2020-01-03',
                    'state' => 'Needs Validation',
                ],
                'expected' => <<<JSON
{
    "creationDate": "2020-01-01",
    "submissionDate": "2020-01-02",
    "validationDate": "2020-01-03",
    "state": "Needs Validation"
}
JSON
            ],
        ];
    }
}
