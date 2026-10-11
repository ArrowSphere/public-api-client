<?php

namespace ArrowSphere\PublicApiClient\Tests\Orders\Entities;

use ArrowSphere\PublicApiClient\Orders\Entities\Contact;
use ArrowSphere\PublicApiClient\Orders\Entities\ExtraInformation;
use ArrowSphere\PublicApiClient\Orders\Entities\Identifiers;
use ArrowSphere\PublicApiClient\Orders\Entities\OrderHistory;
use ArrowSphere\PublicApiClient\Orders\Entities\Partner;
use ArrowSphere\PublicApiClient\Orders\Entities\Prices;
use ArrowSphere\PublicApiClient\Orders\Entities\Program;
use ArrowSphere\PublicApiClient\Orders\Entities\Reference;
use ArrowSphere\PublicApiClient\Orders\Entities\Vendor;
use PHPUnit\Framework\TestCase;

class LeafEntitiesSerializationTest extends TestCase
{
    /**
     * @return array<string, array{class-string, array, string}>
     */
    public static function serializationProvider(): array
    {
        return [
            'contact'                => [Contact::class, ['email' => 'bruce@example.com', 'firstName' => 'Bruce', 'lastName' => 'Wayne'], '{"email":"bruce@example.com","firstName":"Bruce","lastName":"Wayne"}'],
            'extra information'      => [ExtraInformation::class, ['programs' => ['MSCSP' => ['domainName' => 'example.com']]], '{"programs":{"MSCSP":{"domainName":"example.com"}}}'],
            'identifiers'            => [Identifiers::class, ['vendor' => ['sku' => 'MS-0A-O365-BUSINESS']], '{"vendor":{"sku":"MS-0A-O365-BUSINESS"}}'],
            'partner'                => [Partner::class, ['companyName' => 'Wayne industries', 'contact' => ['email' => 'bruce@example.com', 'firstName' => 'Bruce', 'lastName' => 'Wayne']], '{"companyName":"Wayne industries","contact":{"email":"bruce@example.com","firstName":"Bruce","lastName":"Wayne"}}'],
            'prices with decimals'   => [Prices::class, ['buy' => 10.5, 'sell' => 12.25, 'currency' => 'USD', 'periodicity' => 'Monthly', 'term' => 'Annual', 'periodicityCode' => 720, 'termCode' => 8640], '{"buy":10.5,"sell":12.25,"currency":"USD","periodicity":"Monthly","term":"Annual","periodicityCode":720,"termCode":8640}'],
            'prices without decimal' => [Prices::class, ['buy' => 10, 'sell' => 12, 'currency' => 'USD', 'periodicity' => 'Monthly', 'term' => 'Annual', 'periodicityCode' => 720, 'termCode' => 8640], '{"buy":10,"sell":12,"currency":"USD","periodicity":"Monthly","term":"Annual","periodicityCode":720,"termCode":8640}'],
            'program'                => [Program::class, ['legacyCode' => 'microsoft'], '{"legacyCode":"microsoft"}'],
            'reference'              => [Reference::class, ['reference' => 'XSP12345'], '{"reference":"XSP12345"}'],
            'vendor'                 => [Vendor::class, ['sku' => 'MS-0A-O365-BUSINESS'], '{"sku":"MS-0A-O365-BUSINESS"}'],
            'order history'          => [OrderHistory::class, ['orderId' => 'XSP123', 'action' => 'CREATE', 'description' => 'Order created', 'user' => 'Bruce Wayne', 'dateAction' => '2026-01-01 10:00:00'], '{"orderId":"XSP123","action":"CREATE","description":"Order created","user":"Bruce Wayne","dateAction":"2026-01-01 10:00:00"}'],
            'order history defaults' => [OrderHistory::class, ['orderId' => 'XSP123', 'action' => null], '{"orderId":"XSP123","action":"","description":"","user":"","dateAction":""}'],
        ];
    }

    /**
     * @dataProvider serializationProvider
     *
     * @param class-string $class
     */
    public function testSerialization(string $class, array $data, string $expected): void
    {
        self::assertSame($expected, json_encode(new $class($data)));
    }
}
