# Billing statements client

## General information
A billing statement is a way to present your invoice. As a reseller,
use billing preferences to set how billing statements are generated.

## Entities

### Statement
The Statement entity allow to get information about the billing statement header.

| Field                           | Type              | Example                                 | Description                                      |
|---------------------------------|-------------------|-----------------------------------------|--------------------------------------------------|
| reference                       | ```string```      | H1-AAA-0123456789ABCDEF0123456789ABCDEF | Identifier of the statement                      |
| billingGroup                    | ```string```      | ResellerBilling                         | Billing group name                               |
| vendorName                      | ```string```      | Microsoft                               | Vendor name                                      |
| classification                  | ```string```      | saas                                    | End Customer Total Buy Price in vendor currency  |
| reportPeriod                    | ```string```      | 2021-04                                 | Report Period                                    |
| marketplace                     | ```string```      | US                                      | Country code                                     |
| issueDate                       | ```string/null``` | 2021-04-01                              | Date of the issue                                |
| from                            | ```Identity```    |                                         | Identity of the reseller                         |
| to                              | ```Identity```    |                                         | Identities of customers                          |
| currency                        | ```string```      | USD                                     | Country Currency                                 |
| prices                          | ```Prices```      |                                         | Prices for reseller/customer                     |

### Identity
The Identity entity allow to store reference and name about a reseller or a customer.

| Field          | Type         | Example      | Description |
|----------------|--------------|--------------|-------------|
| name           | ```string``` | Reseller 123 |             |
| reference      | ```string``` | XSP123       |             |

### Rates
The Rates entity allow to store reference and name about a reseller or a customer.

| Field          | Type         | Example      | Description |
|----------------|--------------|--------------|-------------|
| sellRate       | ```numeric```| 42.3         |             |
| sellRateType   | ```string``` | uplift       |             |

### Prices
The Prices entity allow to store reference and name about a reseller or a customer.

| Field          | Type                    | Example      | Description               |
|----------------|-------------------------|--------------|---------------------------|
| listUnit       | ```numeric/undefined``` | 12.3         | Retail Unit Price         |
| listTotal      | ```numeric/undefined``` | 12.3         | Retail Total Price        |
| buyUnit        | ```numeric/undefined``` | 12.3         | Reseller Buy Unit Price   |
| buyTotal       | ```numeric```           | 12.3         | Reseller Buy Total Price  |
| sellUnit       | ```numeric/undefined``` | 12.3         | Reseller Sell Unit Price  |
| sellTotal      | ```numeric```           | 12.3         | Reseller Sell Total Price |

### StatementLine
The StatementLine entity allow to get information about a billing statement line.

| Field                           | Type              | Example                                 | Description                                      |
|---------------------------------|-------------------|-----------------------------------------|--------------------------------------------------|
| reference                       | ```string```      | L1-AAA-0123456789ABCDEF0123456789ABCDEF |                                                  |
| vendorEndCustomerSubscriptionId | ```string/null``` |                                         |                                                  |
| vendorName                      | ```string/null``` | Microsoft                               |                                                  |
| vendorProgram                   | ```string/null``` | Vendor Program                          |                                                  |
| vendorProgramClassification     | ```string/null``` |                                         |                                                  |
| vendorProductName               | ```string/null``` | Microsoft Product                       |                                                  |
| vendorSku                       | ```string/null``` |                                         |                                                  |
| arrowSku                        | ```string```      |                                         |                                                  |
| offerName                       | ```string/null``` | Offer Name                              |                                                  |
| subscriptionFriendlyName        | ```string/null``` |                                         |                                                  |
| arsSubscriptionId               | ```string/null``` | XSP123                                  |                                                  |
| orderId                         | ```string/null``` |                                         |                                                  |
| resellerOrderId                 | ```string/null``` |                                         |                                                  |
| subscriptionStartDate           | ```string/null``` | 2020-12-01                              |                                                  |
| subscriptionEndDate             | ```string/null``` | 2021-12-01                              |                                                  |
| billingPeriodicity              | ```string/null``` | Monthly                                 | Monthly or Yearly                                |
| billingPeriodStart              | ```string/null``` | 2021-01-01                              |                                                  |
| billingPeriodEnd                | ```string/null``` | 2021-02-01                              |                                                  |
| usageStartDate                  | ```string```      | 2021-04-02                              |                                                  |
| usageEndDate                    | ```string```      | 2021-04-17                              |                                                  |
| rates                           | ```Rates```       |                                         |                                                  |
| quantity                        | ```string/null``` | 2.0                                     |                                                  |
| currency                        | ```string```      | EUR                                     |                                                  |
| prices                          | ```Prices```      |                                         |                                                  |

## Usage

### Initialization
The "billing statements" client is simply called ```StatementsClient```.
You can get it through the main entry point ```PublicApiClient``` and its method ```getBillingStatementsClient()```, or instanciate it directly:
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
You can list all the statements by calling the ```getStatements()``` method.

This method returns a ```Generator``` and yields instances of the ```Statement``` entity.

Example:
```php
<?php

$periodFrom = '2021-01';
$periodTo = '2021-03';
$statements = $client->getStatements($periodFrom, $periodTo);
foreach ($statements as $statement) {
    echo $statement->getReference() . PHP_EOL;
}
```

### Get a specific statement
You can get a specicif statement by calling the ```getStatement()``` method.

This method returns an instance of the ```Statement``` entity.

Example:

```php
<?php

$statementReference = 'H1-AAA-0123456789ABCDEF0123456789ABCDEF';
$statement = $client->getStatement($statementReference);

echo $statement->getReference() . ': ' . $statement->getStatus() . PHP_EOL;
```

### List the lines of a statement
You can list all the lines of a statement by calling the ```getStatementLines()``` method.

This method returns a ```Generator``` and yields instances of the ```StatementLine``` entity.

Example:
```php
<?php

$statementReference = 'H1-AAA-0123456789ABCDEF0123456789ABCDEF';
$statementLines = $client->getStatementLines($statementReference);
foreach ($statementLines as $statementLine) {
    echo $statementLine->getReference() . PHP_EOL;
}
```
