<?php

namespace ArrowSphere\PublicApiClient\Tests\Entities;

use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Tests\Entities\Fixtures\SampleChild;
use ArrowSphere\PublicApiClient\Tests\Entities\Fixtures\SampleEntity;
use ArrowSphere\PublicApiClient\Tests\Entities\Fixtures\SerializeNullEntity;
use ArrowSphere\PublicApiClient\Tests\Entities\Fixtures\TwoRequiredFieldsEntity;
use ArrowSphere\PublicApiClient\Tests\Entities\Fixtures\UnknownTypeEntity;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class AbstractEntityTest extends TestCase
{
    /**
     * @throws EntitiesException
     */
    public function testHydratesAndSerializesEveryKindOfField(): void
    {
        $entity = new SampleEntity([
            'label'       => 'My label',
            'external_id' => 42,
            'tags'        => ['color' => 'blue'],
            'aliases'     => ['first', 'second'],
            'child'       => ['name' => 'child'],
            'children'    => [['name' => 'one'], ['name' => 'two']],
            'createdAt'   => '2026-10-10T12:00:00+00:00',
            'notMapped'   => 'ignored',
        ]);

        self::assertSame('My label', $entity->getLabel());
        self::assertSame(42, $entity->getExternalId());
        self::assertInstanceOf(SampleChild::class, $entity->getChild());
        self::assertCount(2, $entity->getChildren());
        self::assertInstanceOf(SampleChild::class, $entity->getChildren()[1]);
        self::assertInstanceOf(DateTimeImmutable::class, $entity->getCreatedAt());
        self::assertSame('internal', $entity->getNotMapped());

        self::assertEquals([
            'label'       => 'My label',
            'external_id' => 42,
            'tags'        => ['color' => 'blue'],
            'aliases'     => ['first', 'second'],
            'child'       => ['name' => 'child'],
            'children'    => [['name' => 'one'], ['name' => 'two']],
            'createdAt'   => '2026-10-10T12:00:00+00:00',
        ], $entity->jsonSerialize());
    }

    /**
     * @throws EntitiesException
     */
    public function testAcceptsAnAlreadyBuiltNestedEntity(): void
    {
        $entity = new SampleEntity([
            'external_id' => 1,
            'child'       => new SampleChild(['name' => 'child']),
        ]);

        self::assertSame(['name' => 'child'], $entity->getChild()->jsonSerialize());
    }

    /**
     * @throws EntitiesException
     */
    public function testOmitsMissingOptionalFieldsAndTreatsEmptyArraysAsMissing(): void
    {
        $entity = new SampleEntity([
            'external_id' => 1,
            'label'       => null,
            'tags'        => [],
        ]);

        self::assertNull($entity->getTags());
        self::assertSame(['external_id' => 1], $entity->jsonSerialize());
    }

    public function testReportsEveryMissingRequiredField(): void
    {
        $this->expectException(EntitiesException::class);
        $this->expectExceptionMessage(TwoRequiredFieldsEntity::class . ': Missing field: first, Missing field: second');

        new TwoRequiredFieldsEntity([]);
    }

    public function testRejectsANonScalarValueForAScalarField(): void
    {
        $this->expectException(EntitiesException::class);
        $this->expectExceptionMessage('Invalid value for scalar field external_id: type array instead of int');

        new SampleEntity(['external_id' => ['not', 'scalar']]);
    }

    public function testReportsAnUnknownClassType(): void
    {
        $this->expectException(EntitiesException::class);
        $this->expectExceptionMessage('Missing class: ArrowSphere\PublicApiClient\Tests\Entities\Fixtures\DoesNotExist');

        new UnknownTypeEntity(['thing' => 'value']);
    }

    /**
     * @throws EntitiesException
     */
    public function testProvidesMagicGettersAndSetters(): void
    {
        $entity = new SampleEntity(['external_id' => 1]);

        self::assertSame($entity, $entity->setLabel('Updated'));
        self::assertSame('Updated', $entity->getLabel());
        self::assertNull($entity->unknownMethod());
    }

    /**
     * @return array<string, array{array, array}>
     */
    public static function serializeNullProvider(): array
    {
        return [
            'missing'   => [['reference' => 'XSP12345'], ['reference' => 'XSP12345', 'headcount' => null]],
            'null'      => [['reference' => 'XSP12345', 'headcount' => null], ['reference' => 'XSP12345', 'headcount' => null]],
            'with data' => [['reference' => 'XSP12345', 'headcount' => '50'], ['reference' => 'XSP12345', 'headcount' => '50']],
        ];
    }

    /**
     * @dataProvider serializeNullProvider
     *
     * @throws EntitiesException
     */
    public function testSerializesANullFieldWhenAsked(array $data, array $expected): void
    {
        self::assertSame($expected, (new SerializeNullEntity($data))->jsonSerialize());
    }
}
