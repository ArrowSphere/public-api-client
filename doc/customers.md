# Customers client

## General information

The information below aims to manage the end customers. As a reseller, you need to manage your end customers and their licenses. This is how you list and manage them.

## Entities

### Customer

An end customer is managed by the `Customer` entity.

| Field             | Type             | Example                  | Description                                                                |
| ----------------- | ---------------- | ------------------------ | -------------------------------------------------------------------------- |
| addressLine1      | `string`         | 1007 Mountain Drive      | First line of the address                                                  |
| addressLine2      | `string`         | Wayne Manor              | Second line of the address                                                 |
| billingId         | `string`         |                          | Billing identifier                                                         |
| city              | `string`         | Gotham City              | The city name                                                              |
| companyName       | `string`         | Wayne industries         | The company name                                                           |
| contact           | `Contact`        |                          | The main contact of the company (see [Contact entity](#Contact))           |
| countryCode       | `string`         | US                       | ISO-3166-1 alpha-2 country code                                            |
| details           | `CompanyDetails` |                          | Vendor-specific information (see [CompanyDetails entity](#CompanyDetails)) |
| deletedAt         | `string`         |                          | The date when the customer was deleted                                     |
| emailContact      | `string`         | nobody@example.com       | Contact email for the company                                              |
| headcount         | `string`         | null                     | Head count                                                                 |
| internalReference | `string`         |                          | Internal reference (must be unique if not empty)                           |
| receptionPhone    | `string`         | 1-800-555-1111           | Phone number                                                               |
| ref               | `string`         | COMPANY12345             | Accronym                                                                   |
| reference         | `string`         | XSP12345                 | The identifier of the company within ArrowSphere                           |
| state             | `string`         | NJ                       | State                                                                      |
| taxNumber         | `string`         |                          | VAT number                                                                 |
| websiteUrl        | `string`         | https://www.dccomics.com | Company's website                                                          |
| zip               | `string`         | 12345                    | Zip code                                                                   |

### Contact

The `Contact` entity allows to manage the company's main contact:

| Field     | Type     | Example          | Description  |
| --------- | -------- | ---------------- | ------------ |
| Email     | `string` | test@example.com | E-mail       |
| FirstName | `string` | Bruce            | First name   |
| LastName  | `string` | Wayne            | Last name    |
| Phone     | `string` | 1-800-555-1234   | Phone number |

### CompanyDetails

The `CompanyDetails` entity allows to manage the company's vendor-specific information:

| Field             | Type     | Example              | Description                                              |
| ----------------- | -------- | -------------------- | -------------------------------------------------------- |
| DomainName        | `string` | example.com          | Domain name on Microsoft Azure                           |
| IBMCeId           | `string` | ibm CE Id            | IBM CE id                                                |
| Maas360ResellerId | `string` | Maas 360 Reseller Id | IBM MaaS 360 reseller id                                 |
| Migration         | `bool`   | false                | Indicates if the customer's account needs to be migrated |
| OracleOnlineKey   | `string` | oracle online key    | Online key for Oracle                                    |
| TenantId          | `string` | tenant id            | Microsoft Tenant id                                      |

## Usage

### Initialization

The "customers" client is simply called `CustomersClient`.
You can get it through the main entry point `PublicApiClient` and its method `getCustomersClient()`, or instanciate it directly:

```php
<?php

use ArrowSphere\PublicApiClient\Customers\CustomersClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new CustomersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);
```

### List all the customers

You can list all the customers by calling the `getCustomers()` method.

This method returns a `Generator` and yields instances of the `Customer` entity.

Example:

```php
<?php

$customers = $client->getCustomers();
foreach ($customers as $customer) {
    echo $customer->getCompanyName() . PHP_EOL;
}
```

### Create a customer

You can create a customer by calling the `createCustomer()` method.

This method returns the reference of the newly created custoemr.

Example:

```php
<?php

use ArrowSphere\PublicApiClient\Customers\Entities\CompanyDetails;
use ArrowSphere\PublicApiClient\Customers\Entities\Contact;
use ArrowSphere\PublicApiClient\Customers\Entities\Customer;

$customer = new Customer([
    Customer::COLUMN_ADDRESS_LINE_1     => '1007 Mountain Drive',
    Customer::COLUMN_ADDRESS_LINE_2     => 'Wayne Manor',
    Customer::COLUMN_BILLING_ID         => '',
    Customer::COLUMN_CITY               => 'Gotham City',
    Customer::COLUMN_COMPANY_NAME       => 'Wayne industries',
    Customer::COLUMN_CONTACT            => [
        Contact::COLUMN_EMAIL      => 'test@example.com',
        Contact::COLUMN_FIRST_NAME => 'Bruce',
        Contact::COLUMN_LAST_NAME  => 'Wayne',
        Contact::COLUMN_PHONE      => '1-800-555-1234',
    ],
    Customer::COLUMN_COUNTRY_CODE       => 'US',
    Customer::COLUMN_DETAILS            => [
        CompanyDetails::COLUMN_DOMAIN_NAME => 'https://www.dccomics.com',
        CompanyDetails::COLUMN_MIGRATION   => false,
    ],
    Customer::COLUMN_EMAIL_CONTACT      => 'nobody@example.com',
    Customer::COLUMN_HEADCOUNT          => null,
    Customer::COLUMN_INTERNAL_REFERENCE => '',
    Customer::COLUMN_RECEPTION_PHONE    => '1-800-555-1111',
    Customer::COLUMN_REF                => 'COMPANY12345',
    Customer::COLUMN_STATE              => 'NJ',
    Customer::COLUMN_TAX_NUMBER         => '',
    Customer::COLUMN_WEBSITE_URL        => 'https://www.dccomics.com',
    Customer::COLUMN_ZIP                => '12345',
]);

$reference = $client->createCustomer($customer);

echo "New customer's reference is: " . $reference . PHP_EOL;
```
