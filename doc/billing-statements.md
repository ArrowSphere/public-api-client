# Billing statements client

## General information

A billing statement is a way to present your invoice. As a reseller,
use billing preferences to set how billing statements are generated.

## Entities

### Statement

The Statement entity allow to get information about the billing statement header.

| Field              | Type                   | Example                                 | Description                                                    |
| ------------------ | ---------------------- | --------------------------------------- | -------------------------------------------------------------- |
| billingGroup       | `string`               | ResellerBilling                         | Billing group name                                             |
| billingStrategy    | `null`                 |                                         | Reserved for future use                                        |
| classification     | `string`               | saas                                    | End Customer Total Buy Price in vendor currency                |
| currency           | `string`               | USD                                     | Country Currency                                               |
| description        | `string`               |                                         | Rule's name that led to this statement                         |
| from               | `Identity`             |                                         | Identity of the reseller                                       |
| issueDate          | `string/null`          | 2021-04-01                              | Date of the issue                                              |
| marketplace        | `string`               | US                                      | Country code                                                   |
| prices             | `Prices`               |                                         | Prices for reseller/customer                                   |
| programCode        | `string/null`          | MSCSP                                   | Program name, null if multiple programs for the same statement |
| reference          | `string`               | H1-AAA-0123456789ABCDEF0123456789ABCDEF | Identifier of the statement                                    |
| reportPeriod       | `string`               | 2021-04                                 | Report Period                                                  |
| sequence           | `string`               | MSM12-0123456789                        | Sequence of the statement                                      |
| status             | `null`                 |                                         | Reserved for future use                                        |
| to                 | `Identity`             |                                         | Identities of customers                                        |
| vendorName         | `string`               | Microsoft                               | Vendor name                                                    |

### Identity

The Identity entity allow to store reference and name about a reseller or a customer.

| Field     | Type     | Example      | Description |
| --------- | -------- | ------------ | ----------- |
| name      | `string` | Reseller 123 |             |
| reference | `string` | XSP123       |             |

### Rates

The Rates entity allow to store reference and name about a reseller or a customer.

| Field        | Type      | Example | Description |
| ------------ | --------- | ------- | ----------- |
| sellRate     | `numeric` | 42.3    |             |
| sellRateType | `string`  | uplift  |             |

### Prices

The Prices entity allow to store reference and name about a reseller or a customer.

| Field     | Type                | Example | Description               |
| --------- | ------------------- | ------- | ------------------------- |
| buyTotal  | `numeric`           | 12.3    | Reseller Buy Total Price  |
| buyUnit   | `numeric/undefined` | 12.3    | Reseller Buy Unit Price   |
| listTotal | `numeric/undefined` | 12.3    | Retail Total Price        |
| listUnit  | `numeric/undefined` | 12.3    | Retail Unit Price         |
| sellTotal | `numeric`           | 12.3    | Reseller Sell Total Price |
| sellUnit  | `numeric/undefined` | 12.3    | Reseller Sell Unit Price  |

### StatementLine

The StatementLine entity allow to get information about a billing statement line.

| Field                           | Type          | Example                                 | Description               |
| ------------------------------- | ------------- | --------------------------------------- | ------------------------- |
| arrowSku                        | `string`      |                                         |                           |
| arsSubscriptionId               | `string/null` | XSP123                                  |                           |
| billingPeriodEnd                | `string/null` | 2021-02-01                              |                           |
| billingPeriodStart              | `string/null` | 2021-01-01                              |                           |
| billingPeriodicity              | `string/null` | Monthly                                 | Monthly or Yearly         |
| classification                  | `string/null` |                                         |                           |
| currency                        | `string`      | EUR                                     |                           |
| description                     | `string/null` | Description                             | Line-specific description |
| offerName                       | `string/null` | Offer Name                              |                           |
| orderId                         | `string/null` |                                         |                           |
| prices                          | `Prices`      |                                         |                           |
| programCode                     | `string/null` | MSCSP                                   |                           |
| quantity                        | `string/null` | 2.0                                     |                           |
| rates                           | `Rates`       |                                         |                           |
| reference                       | `string`      | L1-AAA-0123456789ABCDEF0123456789ABCDEF |                           |
| resellerOrderId                 | `string/null` |                                         |                           |
| subscriptionEndDate             | `string/null` | 2021-12-01                              |                           |
| subscriptionFriendlyName        | `string/null` |                                         |                           |
| subscriptionStartDate           | `string/null` | 2020-12-01                              |                           |
| usageEndDate                    | `string`      | 2021-04-17                              |                           |
| usageStartDate                  | `string`      | 2021-04-02                              |                           |
| vendorEndCustomerSubscriptionId | `string/null` |                                         |                           |
| vendorName                      | `string/null` | Microsoft                               |                           |
| vendorProductName               | `string/null` | Microsoft Product                       |                           |
| vendorSku                       | `string/null` |                                         |                           |

## Usage

### Initialization

The "billing statements" client is simply called `StatementsClient`.
You can get it through the main entry point `PublicApiClient` and its method `getBillingStatementsClient()`, or instanciate it directly:

```php
<?php

use ArrowSphere\PublicApiClient\Billing\StatementsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new StatementsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);
```

### List all the statements

You can list all the statements by calling the `getStatements()` method.

This method returns a `Generator` and yields instances of the `Statement` entity.

Example:

```php
<?php

$parameters = [
    StatementsClient::REPORT_PERIOD => '2021-01'
];
$statements = $client->getStatements($parameters);
foreach ($statements as $statement) {
    echo $statement->getReference() . PHP_EOL;
}
```

### Get a specific statement

You can get a specicif statement by calling the `getStatement()` method.

This method returns an instance of the `Statement` entity.

Example:

```php
<?php

$statementReference = 'H1-AAA-0123456789ABCDEF0123456789ABCDEF';
$statement = $client->getStatement($statementReference);

echo $statement->getReference() . ': ' . $statement->getStatus() . PHP_EOL;
```

### List the lines of a statement

You can list all the lines of a statement by calling the `getStatementLines()` method.

This method returns a `Generator` and yields instances of the `StatementLine` entity.

Example:

```php
<?php

$statementReference = 'H1-AAA-0123456789ABCDEF0123456789ABCDEF';
$statementLines = $client->getStatementLines($statementReference);
foreach ($statementLines as $statementLine) {
    echo $statementLine->getReference() . PHP_EOL;
}
```

### Export lines from statements

You can ask for an export (available through your xSP account) by calling the `createExport()` method.

Example:

```php
<?php
$parameters = [
    StatementsClient::REPORT_PERIOD => ['2021-04']
];

$client->createExport($parameters);
```
