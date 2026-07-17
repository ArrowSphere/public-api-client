# Organization Units client

## General information

The information below aims to manage organization units. As a reseller, you can group your end customers into organization units for easier management.

## Entities

### OrganizationUnit

An organization unit is managed by the `OrganizationUnit` entity.

| Field               | Type     | Example      | Description                                            |
|---------------------|----------|--------------|--------------------------------------------------------|
| organizationUnitRef | `string` | OU-REF-001   | The unique reference of the organization unit          |
| companyRef          | `string` | COMPANY-001  | The reference of the company this unit belongs to      |
| name                | `string` | Unit Alpha   | The name of the organization unit                      |
| countUsers          | `int`    | 5            | Number of users assigned to this organization unit     |
| countCustomers      | `int`    | 3            | Number of customers assigned to this organization unit |

### OrganizationUnitsResponse

The `OrganizationUnitsResponse` entity wraps a paginated list of organization units.

| Field             | Type                 | Description                              |
|-------------------|----------------------|------------------------------------------|
| organizationUnits | `OrganizationUnit[]` | List of organization units for this page |
| pagination        | `Pagination`         | Pagination information                   |

## Usage

### Initialization

The "organization units" client is called `OrganizationUnitsClient`.
You can instantiate it directly:

```php
<?php

use ArrowSphere\PublicApiClient\OrganizationUnits\OrganizationUnitsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrganizationUnitsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);
```

### List all organization units

You can list all organization units by calling the `getOrganizationUnits()` method.

This method returns a `Generator` and yields instances of the `OrganizationUnit` entity.

Example:

```php
<?php

$units = $client->getOrganizationUnits();
foreach ($units as $unit) {
    echo $unit->getName() . PHP_EOL;
}
```

### List organization units (paginated)

You can retrieve a single page of organization units by calling the `getOrganizationUnitsPage()` method.

This method returns an `OrganizationUnitsResponse` entity containing the list for the current page and pagination details.

Example:

```php
<?php

$client->setPage(1)->setPerPage(10);

$response = $client->getOrganizationUnitsPage();

foreach ($response->getOrganizationUnits() as $unit) {
    echo $unit->getName() . PHP_EOL;
}

$pagination = $response->getPagination();
echo "Page " . $pagination->getCurrentPage() . " of " . $pagination->getTotalPage() . PHP_EOL;
```

### Get a single organization unit

You can retrieve a single organization unit by its reference using the `getOrganizationUnit()` method.

Example:

```php
<?php

$unit = $client->getOrganizationUnit('OU-REF-001');

echo $unit->getName() . PHP_EOL;
echo $unit->getCountUsers() . PHP_EOL;
```

### Create an organization unit

You can create a new organization unit by calling the `createOrganizationUnit()` method.

This method returns the newly created `OrganizationUnit` entity.

Example:

```php
<?php

use ArrowSphere\PublicApiClient\OrganizationUnits\Entities\OrganizationUnit;

$unit = new OrganizationUnit([
    OrganizationUnit::COLUMN_COMPANY_REFERENCE => 'COMPANY-001',
    OrganizationUnit::COLUMN_NAME              => 'Unit Alpha',
]);

$created = $client->createOrganizationUnit($unit);

echo "Created unit reference: " . $created->getOrganizationUnitRef() . PHP_EOL;
```

### Update an organization unit

You can update an existing organization unit by calling the `updateOrganizationUnit()` method.

This method returns the updated `OrganizationUnit` entity.

Example:

```php
<?php

use ArrowSphere\PublicApiClient\OrganizationUnits\Entities\OrganizationUnit;

$unit = new OrganizationUnit([
    OrganizationUnit::COLUMN_REFERENCE         => 'OU-REF-001',
    OrganizationUnit::COLUMN_COMPANY_REFERENCE => 'COMPANY-001',
    OrganizationUnit::COLUMN_NAME              => 'Unit Alpha Renamed',
]);

$updated = $client->updateOrganizationUnit($unit);

echo "Updated unit name: " . $updated->getName() . PHP_EOL;
```

### Delete an organization unit

You can delete an organization unit by calling the `deleteOrganizationUnit()` method with its reference.

Example:

```php
<?php

$client->deleteOrganizationUnit('OU-REF-001');
```
