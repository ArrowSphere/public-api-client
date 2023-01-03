# ERP Lines client

## General information
ArrowSphere stores it's own version of the **ERP Lines**.

**ERP Lines** as seen within the context of this client, are Billing Statement Lines 
that have been associated to enough informations for them to be sent to each country's 
ERPs that'll issue local invoices.

These are the closest representation to Invoice Lines.
In future versions, we wont need to distinguish ERP Lines & Billing Statement Lines.

## Entities

### ErpExportType

This entity represents a set of columns belong to ERP Lines to be exported together.

This way subsequent demands of access to data, will always respect the format defined 
by this column set without the need of specifying it at every request.

| Field              | Type                   | Example                                                                        | Description                                        |
| ------------------ | ---------------------- | -------------------------------------------------------------------------------| -------------------------------------------------- |
| name               | `string`               | Standard                                                                       | export friendlyName                                |
| columns            | `array`                | ['column-reference1' => 'Friendly Name','column-reference2' => 'Vendor Name']  | list of columns to export                          |

## Usage

### Initialization

The "erp exports" client is simply called `ErpExportsClient`.
You can get it through the main entry point `PublicApiClient` and its method `getErpExportsClient()`, or instanciate it directly:

```php
<?php

use ArrowSphere\PublicApiClient\Billing\ErpExportsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new ErpExportsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);
```

### List all the billing erp exportable columns

You can list all the billing erp exportable columns by calling the `getErpExportsColumns()` method.

This method returns a `array` that contains keys that represent the columns refrence and values that represent columns friendlyName.

Example:

```php
<?php

$columns = $client->getErpExportsColumns();
foreach ($columns as $key => $value) {
    echo "column-reference: {$key} => friendly-name: {$value}\n";
}
```

### List all the billing erp export types 

You can list all the billing erp export types by calling the `getErpExportsTypes()` method.

This method returns a `array` that contains keys that represent the export type refrence and values that represent export type friendlyName.

Example:

```php
<?php

$types = $client->getErpExportsTypes();
foreach ($types as $key => $value) {
    echo "type-reference: {$key} => friendly-name: {$value} ";
}
```

### Get a specific billing erp export type

You can get a specicif billing erp export type by calling the `getErpExportsType()` method.

This method returns an instance of the `ErpExportType` entity.

Example:

```php
<?php

$exportTypeRefrence = 'type-refrence-1';
$exportType = $client->getErpExportsType($exportTypeRefrence);

echo $exportType->getName();
foreach ($exportType->getColumns() as $key => $value) {
    echo "column-reference: {$key} => friendly-name: {$value} ";
}
```

### Create/Update a billing erp export type

You can create or update a new billing erp export type by calling the `createErpExportsType()` method.

This method returns the export type refrence.

Example:

```php
<?php

$parameters = [
    ErpExportsClient::TYPE_NAME => 'Standard',
    ErpExportsClient::TYPE_COLUMNS => [
        'column-reference1' => 'Friendly Name',
        'column-reference2' => 'Vendor Name',
    ]
];

$exportTypeRef = $client->createErpExportsType($parameters);
echo "export type reference: {$exportTypeRef}";
```
### Delete a billing erp export type

You can delete existing billing erp export type by calling the `deleteErpExportsType()` method.

Example:

```php
<?php
$exportTypeRefrence = 'type-refrence-1';

$client->deleteErpExportsType($parameters);
```

### Export billing erp lines

You can ask for an export (available through your xSP account) by calling the `createErpExportsAsync()` method.

This method returns the export refrence.

Example:

```php
<?php
$parameters = [
    ErpExportsClient::EXPORT_TYPE_REFERENCE => 'DJ284LDZ-standard',
    ErpExportsClient::EXPORT_OUTPUT_FORMAT => [
        ErpExportsClient::EXPORT_OUTPUT_FORMAT_DATE => 'DD-MM-YYYfefdY',
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

$exportReference = $client->createErpExportsAsync($parameters);
echo "export reference: {$exportReference}";
```
