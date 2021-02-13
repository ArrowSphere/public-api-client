<?php

namespace ArrowSphere\PublicApiClient\Tests\Customers;

use ArrowSphere\PublicApiClient\Customers\CustomersClient;
use ArrowSphere\PublicApiClient\Customers\Entities\Customer;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

/**
 * Class CustomersClientTest
 *
 * @property CustomersClient $client
 */
class CustomersClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = CustomersClient::class;

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetCustomersRaw(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/customers?abc=def&ghi=0')
            ->willReturn(new Response(200, [], 'OK USA'));

        $this->client->getCustomersRaw([
            'abc' => 'def',
            'ghi' => false,
        ]);
    }

    /**
     * @depends testGetCustomersRaw
     *
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function testGetCustomersWithInvalidResponse(): void
    {
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/customers?abc=def&ghi=0&per_page=100')
            ->willReturn(new Response(200, [], '{'));

        $this->expectException(PublicApiClientException::class);
        $customers = $this->client->getCustomers([
            'abc' => 'def',
            'ghi' => false,
        ]);
        iterator_to_array($customers);
    }

    /**
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws PublicApiClientException
     */
    public function testGetCustomersWithPagination(): void
    {
        $response = json_encode([
            'data'       => [
                'customers' => [],
            ],
            'pagination' => [
                'total_page' => 3,
            ],
        ]);

        $this->httpClient
            ->expects(self::exactly(3))
            ->method('request')
            ->withConsecutive(
                ['get', 'https://www.test.com/customers?abc=def&ghi=0&per_page=100'],
                ['get', 'https://www.test.com/customers?abc=def&ghi=0&page=2&per_page=100'],
                ['get', 'https://www.test.com/customers?abc=def&ghi=0&page=3&per_page=100']
            )
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getCustomers([
            'abc' => 'def',
            'ghi' => false,
        ]);
        iterator_to_array($test);
    }

    /**
     * @throws PublicApiClientException
     */
    public function testGetCustomers(): void
    {
        $response = <<<JSON
{
  "status": 200,
  "data": {
    "customers": [
      {
        "AddressLine1": "1007 Mountain Drive",
        "AddressLine2": "Wayne Manor",
        "BillingId": "123",
        "City": "Gotham City",
        "CompanyName": "Wayne industries",
        "Contact": {
          "Email": "test@example.com",
          "FirstName": "Bruce",
          "LastName": "Wayne",
          "Phone": "1-800-555-1234"
        },
        "CountryCode": "US",
        "Details": [],
        "DeletedAt": null,
        "EmailContact": "nobody@example.com",
        "Headcount": null,
        "InternalReference": "",
        "ReceptionPhone": "1-800-555-1111",
        "Ref": "COMPANY12345",
        "Reference": "XSP12345",
        "State": "NJ",
        "TaxNumber": "",
        "WebsiteUrl": "https:\/\/www.dccomics.com",
        "Zip": "12345"
      },
      {
        "AddressLine1": "855 Main Street",
        "AddressLine2": "Police Department",
        "BillingId": "456",
        "City": "Central City",
        "CompanyName": "Central City Police Department",
        "Contact": {
          "Email": "test2@example.com",
          "FirstName": "Barry",
          "LastName": "Allen",
          "Phone": "1-800-555-5678"
        },
        "CountryCode": "US",
        "Details": [],
        "DeletedAt": null,
        "EmailContact": "nobody@example.com",
        "Headcount": null,
        "InternalReference": "",
        "ReceptionPhone": "1-800-555-1111",
        "Ref": "COMPANY12346",
        "Reference": "XSP12346",
        "State": "MO",
        "TaxNumber": "",
        "WebsiteUrl": "https:\/\/www.dccomics.com",
        "Zip": "12346"
      }
    ]
  },
  "pagination": {
    "per_page": 100,
    "current_page": 1,
    "total_page": 1,
    "total": 2,
    "next": null,
    "previous": null
  }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('get', 'https://www.test.com/customers?abc=def&ghi=0&per_page=100')
            ->willReturn(new Response(200, [], $response));

        $test = $this->client->getCustomers([
            'abc' => 'def',
            'ghi' => false,
        ]);
        $list = iterator_to_array($test);
        self::assertCount(2, $list);

        /** @var Customer $customer */
        $customer = array_shift($list);
        self::assertInstanceOf(Customer::class, $customer);
        self::assertSame('1007 Mountain Drive', $customer->getAddressLine1());
        self::assertSame('Wayne Manor', $customer->getAddressLine2());
        self::assertSame('123', $customer->getBillingId());
        self::assertSame('Gotham City', $customer->getCity());
        self::assertSame('Wayne industries', $customer->getCompanyName());
        self::assertSame('test@example.com', $customer->getContact()->getEmail());
        self::assertSame('Bruce', $customer->getContact()->getFirstName());
        self::assertSame('Wayne', $customer->getContact()->getLastName());
        self::assertSame('1-800-555-1234', $customer->getContact()->getPhone());
        self::assertSame('US', $customer->getCountryCode());
        self::assertNull($customer->getDeletedAt());
        self::assertSame('nobody@example.com', $customer->getEmailContact());
        self::assertNull($customer->getHeadcount());
        self::assertSame('', $customer->getInternalReference());
        self::assertSame('1-800-555-1111', $customer->getReceptionPhone());
        self::assertSame('COMPANY12345', $customer->getRef());
        self::assertSame('XSP12345', $customer->getReference());
        self::assertSame('NJ', $customer->getState());
        self::assertSame('', $customer->getTaxNumber());
        self::assertSame('https://www.dccomics.com', $customer->getWebsiteUrl());

        /** @var Customer $customer */
        $customer = array_shift($list);
        self::assertInstanceOf(Customer::class, $customer);
        self::assertSame('855 Main Street', $customer->getAddressLine1());
        self::assertSame('Police Department', $customer->getAddressLine2());
        self::assertSame('456', $customer->getBillingId());
        self::assertSame('Central City', $customer->getCity());
        self::assertSame('Central City Police Department', $customer->getCompanyName());
        self::assertSame('test2@example.com', $customer->getContact()->getEmail());
        self::assertSame('Barry', $customer->getContact()->getFirstName());
        self::assertSame('Allen', $customer->getContact()->getLastName());
        self::assertSame('1-800-555-5678', $customer->getContact()->getPhone());
        self::assertSame('US', $customer->getCountryCode());
        self::assertNull($customer->getDeletedAt());
        self::assertSame('nobody@example.com', $customer->getEmailContact());
        self::assertNull($customer->getHeadcount());
        self::assertSame('', $customer->getInternalReference());
        self::assertSame('1-800-555-1111', $customer->getReceptionPhone());
        self::assertSame('COMPANY12346', $customer->getRef());
        self::assertSame('XSP12346', $customer->getReference());
        self::assertSame('MO', $customer->getState());
        self::assertSame('', $customer->getTaxNumber());
        self::assertSame('https://www.dccomics.com', $customer->getWebsiteUrl());
    }

    /**
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws EntityValidationException
     * @throws GuzzleException
     */
    public function testCreateCustomer(): void
    {
        $payload = [
            'AddressLine1'      => '1007 Mountain Drive',
            'AddressLine2'      => 'Wayne Manor',
            'BillingId'         => '',
            'City'              => 'Gotham City',
            'CompanyName'       => 'Wayne industries',
            'Contact'           => [
                'Email'     => 'test@example.com',
                'FirstName' => 'Bruce',
                'LastName'  => 'Wayne',
                'Phone'     => '1-800-555-1234',
            ],
            'CountryCode'       => 'US',
            'Details'           => [
                'DomainName' => 'https://www.dccomics.com',
                'Migration'  => false,
            ],
            'EmailContact'      => 'nobody@example.com',
            'Headcount'         => null,
            'InternalReference' => '',
            'ReceptionPhone'    => '1-800-555-1111',
            'Ref'               => 'COMPANY12345',
            'State'             => 'NJ',
            'TaxNumber'         => '',
            'WebsiteUrl'        => 'https://www.dccomics.com',
            'Zip'               => '12345',
        ];

        $customer = new Customer($payload);

        $response = <<<JSON
{
    "status": 201,
    "data": {
        "reference": "XSP123456"
    }
}
JSON;

        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with('post', 'https://www.test.com/customers?abc=def&ghi=0', [
                'headers' => [
                    'apiKey' => '123456',
                ],
                'body'    => json_encode($payload),
            ])
            ->willReturn(new Response(200, [], $response));

        $reference = $this->client->createCustomer($customer, [
            'abc' => 'def',
            'ghi' => false,
        ]);

        self::assertSame('XSP123456', $reference);
    }
}
