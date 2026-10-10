<?php

namespace ArrowSphere\PublicApiClient\Tests\Billing;

use ArrowSphere\PublicApiClient\Billing\Entities\ErpExportType;
use ArrowSphere\PublicApiClient\Billing\ErpExportsClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class ErpExportsClientTest
 *
 * @property ErpExportsClient $client
 */
class ErpExportsClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = ErpExportsClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetErpExportsColumnsRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('GET', 'https://www.test.com/billing/erp/exports/columns')
            ->willReturn(new Response(200, [], 'OK'));

        $response = $this->client->getErpExportsColumnsRaw();
        self::assertSame('OK', $response);
    }

    /**
     * @depends testGetErpExportsColumnsRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetErpExportsColumns(): void
    {
        $response = json_encode([
            'code' => 0,
            'message' => 'success',
            'data' => [
                'columns' => [
                    'column-reference1' => 'Friendly Name',
                    'column-reference2' => 'Vendor Name',
                ],
            ],
        ]);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('GET', 'https://www.test.com/billing/erp/exports/columns')
            ->willReturn(new Response(200, [], $response));

        $exportColumns = $this->client->getErpExportsColumns();
        self::assertIsArray($exportColumns);
        self::assertSame('Friendly Name', $exportColumns['column-reference1']);
        self::assertSame('Vendor Name', $exportColumns['column-reference2']);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetErpExportsTypesRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('GET', 'https://www.test.com/billing/erp/exports/types')
            ->willReturn(new Response(200, [], 'OK'));

        $response = $this->client->getErpExportsTypesRaw();
        self::assertSame('OK', $response);
    }

    /**
     * @depends testGetErpExportsTypesRaw
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetErpExportsTypes(): void
    {
        $response = json_encode([
            'code' => 0,
            'message' => 'success',
            'data' => [
                'exportTypes' => [
                    'export-type-reference1' => 'Standard',
                    'export-type-reference2' => 'Light',
                ],
            ],
        ]);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('GET', 'https://www.test.com/billing/erp/exports/types')
            ->willReturn(new Response(200, [], $response));

        $exportTypes = $this->client->getErpExportsTypes();
        self::assertIsArray($exportTypes);
        self::assertSame('Standard', $exportTypes['export-type-reference1']);
        self::assertSame('Light', $exportTypes['export-type-reference2']);
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetErpExportsTypeRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('GET', 'https://www.test.com/billing/erp/exports/types/1')
            ->willReturn(new Response(200, [], 'OK'));

        $response = $this->client->getErpExportsTypeRaw('1');
        self::assertSame('OK', $response);
    }

    /**
    * @depends testGetErpExportsTypeRaw
    *
    * @throws NotFoundException
    * @throws PublicApiClientException
    * @throws GuzzleException
    */
    public function testGetErpExportsType(): void
    {
        $response = json_encode([
            'code' => 0,
            'message' => 'success',
            'data' => [
                'name' => 'Standard',
                'columns' => [
                    'column-reference1' => 'Friendly Name',
                    'column-reference2' => 'Vendor Name',
                ],
            ],
        ]);

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('GET', 'https://www.test.com/billing/erp/exports/types/1')
            ->willReturn(new Response(200, [], $response));

        $exportType = $this->client->getErpExportsType('1');
        self::assertInstanceOf(ErpExportType::class, $exportType);
        self::assertSame('Standard', $exportType->getName());
        self::assertSame(['column-reference1' => 'Friendly Name', 'column-reference2' => 'Vendor Name'], $exportType->getColumns());
    }

    /**
    * @throws NotFoundException
    * @throws PublicApiClientException
    * @throws GuzzleException
    */
    public function testDeleteErpExportsType(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('DELETE', 'https://www.test.com/billing/erp/exports/types/1')
            ->willReturn(new Response(200, [], 'OK'));

        $response = $this->client->deleteErpExportsType('1');
        self::assertSame('OK', $response);
    }

    /**
    * @throws NotFoundException
    * @throws PublicApiClientException
    * @throws ReflectionException
    * @throws GuzzleException
    */
    public function testPostExport(): void
    {
        $response = json_encode([
            'code' => 0,
            'message' => 'success',
            'data' => [
                'requestRef' => '1234567890'
            ],
        ]);
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'POST',
                'https://www.test.com/billing/erp/exports/async',
                [
                    'body'    => '{"exportTypeReference":"DJ284LDZ-standard","outputFormat":{"date":"DD-MM-YYYY","file":"csv"},"filters":{"issueDate":{"from":"2020-02-21","to":"2020-02-21"},"validationDate":{"from":"2020-02-21","to":"2020-02-21"},"subscriptionDate":{"from":"2020-02-21","to":"2020-02-21"},"createdAt":{"from":"2020-02-21","to":"2020-02-21"},"reportPeriod":{"from":"2021-06","to":"2021-06"},"classifications":["IAAS"],"vendors":["Microsoft"],"programs":["MSCSP"],"marketplaces":["PT"],"sequences":["MIM22-123-456"],"references":["L1-MIM-0123456689abcdef"],"resellerXspRefs":["XSP1337"],"resellerCompanyTags":["TIER2"],"customerXspRefs":["XSP1337"],"vendorSubscriptionIds":["0fcbbdfc-3092-446f-aab7-cbb2c42d13cf"],"friendlyNames":["End Customer subscription friendly name"],"arrowSku":"MS-AZR-0145P"}}',
                    'headers' => [
                        'apiKey'       => '123456',
                        'Content-Type' => 'application/json',
                        'User-Agent'   => $this->userAgentHeader,
                    ],
                ]
            )
            ->willReturn(new Response(200, [], $response));

        $parameters = [
            ErpExportsClient::EXPORT_TYPE_REFERENCE => 'DJ284LDZ-standard',
            ErpExportsClient::EXPORT_OUTPUT_FORMAT => [
                ErpExportsClient::EXPORT_OUTPUT_FORMAT_DATE => 'DD-MM-YYYY',
                ErpExportsClient::EXPORT_OUTPUT_FORMAT_FILE => 'csv',
            ],
            ErpExportsClient::EXPORT_FILTERS => [
                ErpExportsClient::EXPORT_FILTERS_ISSUE_DATE => [
                    ErpExportsClient::EXPORT_FILTERS_DATE_FROM => '2020-02-21',
                    ErpExportsClient::EXPORT_FILTERS_DATE_TO => '2020-02-21',
                ],
                ErpExportsClient::EXPORT_FILTERS_VALIDATION_DATE => [
                    ErpExportsClient::EXPORT_FILTERS_DATE_FROM => '2020-02-21',
                    ErpExportsClient::EXPORT_FILTERS_DATE_TO => '2020-02-21',
                ],
                ErpExportsClient::EXPORT_FILTERS_SUBSCRIPTION_DATE => [
                    ErpExportsClient::EXPORT_FILTERS_DATE_FROM => '2020-02-21',
                    ErpExportsClient::EXPORT_FILTERS_DATE_TO => '2020-02-21',
                ],
                ErpExportsClient::EXPORT_FILTERS_CREATED_AT => [
                    ErpExportsClient::EXPORT_FILTERS_DATE_FROM => '2020-02-21',
                    ErpExportsClient::EXPORT_FILTERS_DATE_TO => '2020-02-21',
                ],
                ErpExportsClient::EXPORT_FILTERS_REPORT_PERIOD => [
                    ErpExportsClient::EXPORT_FILTERS_DATE_FROM => '2021-06',
                    ErpExportsClient::EXPORT_FILTERS_DATE_TO => '2021-06',
                ],
                ErpExportsClient::EXPORT_FILTERS_CLASSIFICATIONS => ['IAAS'],
                ErpExportsClient::EXPORT_FILTERS_VENDORS => ['Microsoft'],
                ErpExportsClient::EXPORT_FILTERS_PROGRAMS => ['MSCSP'],
                ErpExportsClient::EXPORT_FILTERS_MARKETPLACES => ['PT'],
                ErpExportsClient::EXPORT_FILTERS_SEQUENCES => ['MIM22-123-456'],
                ErpExportsClient::EXPORT_FILTERS_REFRENCES => ['L1-MIM-0123456689abcdef'],
                ErpExportsClient::EXPORT_FILTERS_RESELLER_XSP_REFS => ['XSP1337'],
                ErpExportsClient::EXPORT_FILTERS_RESELLER_COMPANY_TAGS => ['TIER2'],
                ErpExportsClient::EXPORT_FILTERS_CUSTOMER_XSP_REFS => ['XSP1337'],
                ErpExportsClient::EXPORT_FILTERS_VENDOR_SUBSCRIPTION_IDS => ['0fcbbdfc-3092-446f-aab7-cbb2c42d13cf'],
                ErpExportsClient::EXPORT_FILTERS_FRIENDLY_NAMES => ['End Customer subscription friendly name'],
                ErpExportsClient::EXPORT_FILTERS_ARROW_SKU => 'MS-AZR-0145P',
            ],
        ];
        $requestRef = $this->client->createErpExportsAsync($parameters);
        self::assertSame('1234567890', $requestRef);
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testCreateErpExportsType(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'PUT',
                'https://www.test.com/billing/erp/exports/types',
                self::callback(static function (array $options): bool {
                    return $options['body'] === json_encode([
                        ErpExportsClient::TYPE_NAME    => 'My export',
                        ErpExportsClient::TYPE_COLUMNS => ['Vendor Name', 'Quantity'],
                    ]);
                })
            )
            ->willReturn(new Response(200, [], json_encode(['status' => 200, 'data' => ['reference' => 'EXPORT-TYPE-1']])));

        $reference = $this->client->createErpExportsType([
            ErpExportsClient::TYPE_NAME    => 'My export',
            ErpExportsClient::TYPE_COLUMNS => ['Vendor Name', 'Quantity'],
            'description'                  => '',
        ]);

        self::assertSame('EXPORT-TYPE-1', $reference);
    }

    /**
     * @return array<string, array{array, string}>
     */
    public static function invalidExportTypeProvider(): array
    {
        return [
            'list instead of named parameters' => [['My export'], 'Error: Invalid parameters value'],
            'missing name'                     => [[ErpExportsClient::TYPE_COLUMNS => ['Quantity']], 'Error: name parameter not found'],
            'missing columns'                  => [[ErpExportsClient::TYPE_NAME => 'My export'], 'Error: columns parameter not found'],
        ];
    }

    /**
     * @dataProvider invalidExportTypeProvider
     *
     * @throws GuzzleException
     * @throws NotFoundException
     */
    public function testCreateErpExportsTypeRejectsInvalidParameters(array $parameters, string $message): void
    {
        $this->httpClient->expects(self::never())->method('request');

        $this->expectException(PublicApiClientException::class);
        $this->expectExceptionMessage($message);

        $this->client->createErpExportsType($parameters);
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testCreateErpExportSyncRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'POST',
                'https://www.test.com/billing/erp/exports/sync',
                self::callback(static function (array $options): bool {
                    return $options['body'] === json_encode([ErpExportsClient::EXPORT_TYPE_REFERENCE => 'EXPORT-TYPE-1']);
                })
            )
            ->willReturn(new Response(200, [], 'OK'));

        self::assertSame('OK', $this->client->createErpExportSyncRaw([
            ErpExportsClient::EXPORT_TYPE_REFERENCE => 'EXPORT-TYPE-1',
            ErpExportsClient::EXPORT_FILTERS        => [],
        ]));
    }

    /**
     * @return array<string, array{array, string}>
     */
    public static function invalidExportSyncProvider(): array
    {
        return [
            'list instead of named parameters' => [['EXPORT-TYPE-1'], 'Error: Invalid parameters value'],
            'invalid date format'              => [
                [ErpExportsClient::EXPORT_OUTPUT_FORMAT => [ErpExportsClient::EXPORT_OUTPUT_FORMAT_DATE => 'YYYY']],
                'Error: Invalid output format date value',
            ],
        ];
    }

    /**
     * @dataProvider invalidExportSyncProvider
     *
     * @throws GuzzleException
     * @throws NotFoundException
     */
    public function testCreateErpExportSyncRawRejectsInvalidParameters(array $parameters, string $message): void
    {
        $this->httpClient->expects(self::never())->method('request');

        $this->expectException(PublicApiClientException::class);
        $this->expectExceptionMessage($message);

        $this->client->createErpExportSyncRaw($parameters);
    }

    /**
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function testCreateErpExportSyncReadsEveryPage(): void
    {
        $pages = [
            'https://www.test.com/billing/erp/exports/sync' => [
                'data'       => ['headers' => ['Vendor', 'Quantity'], 'values' => [['Microsoft', 2]]],
                'pagination' => ['totalPages' => 2],
            ],
            'https://www.test.com/billing/erp/exports/sync?page=2' => [
                'data'       => ['headers' => ['Vendor', 'Quantity'], 'values' => [['Adobe', 5]]],
                'pagination' => ['totalPages' => 2],
            ],
        ];

        $this->httpClient
            ->expects(self::exactly(2))
            ->method('request')
            ->willReturnCallback(static function (string $method, string $url) use ($pages): Response {
                return new Response(200, [], json_encode($pages[$url]));
            });

        $lines = iterator_to_array($this->client->createErpExportSync([ErpExportsClient::EXPORT_TYPE_REFERENCE => 'EXPORT-TYPE-1']), false);

        self::assertSame([
            ['Vendor' => 'Microsoft', 'Quantity' => 2],
            ['Vendor' => 'Adobe', 'Quantity' => 5],
        ], $lines);
    }

    /**
     * @return array<string, array{array, string}>
     */
    public static function incompleteExportSyncResponseProvider(): array
    {
        return [
            'missing pagination' => [['data' => ['headers' => [], 'values' => []]], 'Error: Pagination not found in response'],
            'missing data'       => [['pagination' => ['totalPages' => 1]], 'Error: Data not found in response'],
        ];
    }

    /**
     * @dataProvider incompleteExportSyncResponseProvider
     *
     * @throws GuzzleException
     * @throws NotFoundException
     */
    public function testCreateErpExportSyncRejectsAnIncompleteResponse(array $response, string $message): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->willReturn(new Response(200, [], json_encode($response)));

        $this->expectException(PublicApiClientException::class);
        $this->expectExceptionMessage($message);

        iterator_to_array($this->client->createErpExportSync([ErpExportsClient::EXPORT_TYPE_REFERENCE => 'EXPORT-TYPE-1']));
    }
}
