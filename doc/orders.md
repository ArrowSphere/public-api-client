# Order Client

## General information

An order is the entity which holds information about the customer's order.
An order is identified in ArrowSphere Cloud by its _order reference_, which is typically 'XSPO' followed by a few
digits (e.g. XSP0345677).

## Request Entities

### OrdersFilters and its sub-entities

OrdersFilters is designed to simplify search process of orders

### OrdersFilters

| Field               | Type         | Example                 | Description                                                           |
|---------------------|--------------|-------------------------|-----------------------------------------------------------------------|
| orderBy             | `?string`    | asc                     | The order of the listing "asc" for ascending or "desc" for descending |
| sortBy              | `?string`    | status                  | The field which the order will be applied on                          |
| from                | `?string`    | 2024-12-01              | From which start date we get orders                                   |
| reference           | `?string`    | XSPO123                 | The order reference                                                   |
| status              | `?string`    | pending validation      | The order status                                                      |
| program             | `?string`    | Microsoft               | The order program                                                     |
| period              | `?string`    | 2023-12-01              | The order creation date                                               |
| lastUpdate          | `?string`    | 2023-12-01              | The order last update date, this filter works on the dateStatus field |
| organizationUnitRef | `?string[]`  | \['XSPOU20', 'XSPOU28'] | The organization unit reference                                       |

### CreateOrder and its sub-entities

#### CreateOrder

To simplify order creating process we design objects structure where dev can simply set the needed attribute

| Field                | Type                 | Example                                       | Description                     |
|----------------------|----------------------|-----------------------------------------------|---------------------------------|
| scheduledDate        | `?string`            | 2024-12-01                                    | Schedule a date for new order   |
| extraInformation     | `ExtraInformation[]` | List of [ExtraInformation](#ExtraInformation) | Define list of Eavs for order   |
| customer             | `Customer`           | [Customer](#Customer)                         | Define end Customer for order   |
| products             | `Product[]`          | List of product [Product](#Product)           | Define List of product of order |

#### Customer

| Field       | Type      | Example | Description              |
|-------------|-----------|---------|--------------------------|
| reference   | `string`  | XSP4533 | customer Ref             |
| ponumber    | `?string` | 133     | Define customer PoNumber |

#### Product

| Field                        | Type         | Example                 | Description                                                                                                                                                                                                                                                     |
|------------------------------|--------------|-------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| parentLicenseId              | `?string`    |                         | This field is mandatory in case of add-ons ordering, if the parentSku is not provided: Set a License ID of an active product with available add-ons (see Catalog or List addons offers by License)                                                              |
| parentSku                    | `?string`    | XXX-XXX-XXXX            | This field is mandatory in case of add-ons ordering, if the parentLicenseId is not provided: Set a SKU of a compatible base product on your current order to attach the add-on to. This way you can order both the base product and the add-on at the same time |
| autoRenew                    | `bool`       | true                    | Auto-renew option available for the subscription initialize by                                                                                                                                                                                                  |
| effectiveStartDate           | `?string`    |                         | This field is restricted to specific rights, format YYYY-MM-DD choose the start date                                                                                                                                                                            |
| effectiveEndDate             | `?string`    |                         | This field is restricted to specific rights, format YYYY-MM-DD choose the end date                                                                                                                                                                              |
| vendorReferenceId            | `?string`    |                         | This field is restricted to specific rights, The vendor reference is used to identify the subscription on vendor side                                                                                                                                           |
| parentVendorReferenceId      | `?string`    |                         | This field is mandatory in case of add-ons ordering, if the parentSku is not provided: Set a License ID of an active product with available add-ons (see Catalog or List addons offers by License)                                                              |
| friendlyName                 | `?string`    | test                    | Initialize the subscription friendlyName                                                                                                                                                                                                                        |
| comment1                     | `?string`    | com1                    | Custom field, add a comment attach to this product                                                                                                                                                                                                              |
| comment2                     | `?string`    | com2                    | Custom field, add a comment attach to this product                                                                                                                                                                                                              |
| discount                     | `?float`     | -5.5                    | Discount rate applied to item list priceString                                                                                                                                                                                                                  |
| uplift                       | `?float`     | 5                       | Uplift rate applied to item buy price                                                                                                                                                                                                                           |
| promotionId                  | `?string`    |                         | PromotionId you want to apply                                                                                                                                                                                                                                   |
| coterminosityDate            | `?string`    |                         | Calculate end date, useful for coterminosity scenario                                                                                                                                                                                                           |
| coterminositySubscriptionRef | `?string`    |                         | Reference license to which we want to align, useful for coterminosity scenario                                                                                                                                                                                  |
| price                        | `?Price`     | [Price](#Price)         | This field is restricted to specific rights, it is used for injection scenario only                                                                                                                                                                             |
| sku                          | `?string`    | XXXX-XXXX-XXX           | This field is mandatory in case of add-ons ordering                                                                                                                                                                                                             |
| arrowSpherePriceBandSku      | `string`     | testArrowsSku           | ArrowSphere unique priceBand SKU you want to buy                                                                                                                                                                                                                |
| quantity                     | `int`        | 133                     | Quantity to purchase                                                                                                                                                                                                                                            |
| subscription                 | `Reference`  | [Reference](#Reference) | Reference of subscription related to the product                                                                                                                                                                                                                |

#### Price

| Field       | Type            | Example                      | Description                        |
|-------------|-----------------|------------------------------|------------------------------------|
| vendor      | `PriceDetail`   | [PriceDetail](#PriceDetail)  | Tier price for Vendor price        |
| buy         | `PriceDetail`   | [PriceDetail](#PriceDetail)  | Tier price for Arrow price         |
| list        | `PriceDetail`   | [PriceDetail](#PriceDetail)  | Tier price for list price          |
| reseller    | `PriceDetail`   | [PriceDetail](#PriceDetail)  | Tier price for reseller price      |
| endCustomer | `PriceDetail`   | [PriceDetail](#PriceDetail)  | Tier price for end customer price  |

#### PriceDetail

| Field        | Type      | Example | Description                       |
|--------------|-----------|---------|-----------------------------------|
| exchangeRate | `?float`  | 0.92    | Mandatory in case of Vendor price |
| currency     | `string`  | USD     | currency                          |
| unitPrice    | `float`   | 3.1     |                                   |

## Response Entities

### Order and its sub-entities

#### Order

An Order is managed by the `Order` entity.

| Field                 | Type               | Example                                     | Description                                                     |
|-----------------------|--------------------|---------------------------------------------|-----------------------------------------------------------------|
| reference             | `String`           | 1234                                        | Order reference ID                                              |
| status                | `String`           | open                                        | Order status                                                    |
| dateStatus            | `String`           | 2024-01-01                                  | Date the current status was updated                             |
| dateCreation          | `String`           | 2023-12-12                                  | Date the order was created                                      |
| orderReference        | `String`           | XSPO1234                                    | Arrow order reference                                           |
| createdBy             | `?String`          | admin                                       | User who create the order                                       |
| createdByImpersonator | `?String`          | admin                                       | User impersonate who create the order                           |
| commitmentAmountTotal | `float`            | 1877.98                                     | Total Amount of the order                                       |
| partner               | `Partner`          | [Partner](#Partner)                         | The partner related to the order                                |
| customer              | `Reference`        | [Reference](#Reference)                     | The end-customer related to the order                           |
| poNumber              | `?String`          | 1234                                        | Order PoNumber                                                  |
| products              | `OrdersProduct[] ` | an array of [OrdersProduct](#OrdersProduct) | The list of [OrdersProduct](#OrdersProduct) linked to the order |
| extraInformation      | `ExtraInformation` | [ExtraInformation](#ExtraInformation)       | Order extraInformation (EAVS)                                   |
| scheduledDate         | `String`           | 2023-12-12                                  | scheduled date of order if exist                                |

#### Partner

The Partner which is related to the order.

| Field       | Type        | Example             | Description                     |
|-------------|-------------|---------------------|---------------------------------|
| companyName | `string`    | test                | The company name of the partner |
| contact     | `Contact[]` | [Contact](#Contact) | The company contact             |

#### Contact

The Contact info related to the Partner.

| Field     | Type     | Example      | Description            |
|-----------|----------|--------------|------------------------|
| email     | `string` | test@test.fr | The contact email      |
| firstName | `string` | Adam         | The contact first name |
| lastName  | `string` | Smith        | The contact last name  |

#### Reference

The Reference is used to identify a global entity like Customer, Subscription, etc.

| Field     | Type     | Example  | Description                 |
|-----------|----------|----------|-----------------------------|
| reference | `string` | XSPS1918 | The reference of the entity |

#### ExtraInformation

The ExtraInformation define the specific field used by vendors

| Field    | Type    | Example                                                | Description                                            |
|----------|---------|--------------------------------------------------------|--------------------------------------------------------|
| programs | `array` | \['ADOBE' => \['adobe_qualification' => 'commercial']] | list of specific field of programs linked to the order |

#### OrdersProduct

The OrderProduct host the product info of the order

| Field              | Type          | Example                                                              | Description                                                    |
|--------------------|---------------|----------------------------------------------------------------------|----------------------------------------------------------------|
| sku                | `string`      | Microsoft\| \|MS-0ZH-VISIO \| \|B4D4B7F4-4089-43B6-9C44-DE97B760FB11 | product Order SKU                                              |
| name               | `string`      | Dynamics 365 Commerce                                                | Product name                                                   |
| classification     | `string`      | SaaS                                                                 | Product classification (IaaS, SaaS, PSW...)                    |
| vendorName         | `string`      | Microsoft                                                            | Product vendor name                                            |
| programName        | `string`      | Microsoft Cloud Solution Provider (CSP)                              | Product Program name                                           |
| program            | `Program`     | [Program](#Program)                                                  |                                                                |
| identifiers        | `Identifiers` | [Identifiers](#Identifiers)                                          | Vendor identifier                                              |
| quantity           | `int`         | 3                                                                    | Number of products bought                                      |
| status             | `string`      | Provisioned                                                          | Order status                                                   |
| dateStatus         | `string`      | 2017-05-15 09:39:05                                                  | Date the product became the current "Status"                   |
| detailedStatus     | `string`      | Provisioned                                                          | An individual product can be a different status than the order |
| isAddon            | `boolean`     | false                                                                | Whether the product is an addon or not                         |
| isTrial            | `boolean`     | false                                                                | Whether the product is a trial or not                          |
| arrowSubCategories | `string[]`    | \[nce]                                                               | Indicates if the product has subCategories like nce from MSC   |
| prices             | `Prices`      | [Prices](#Prices)                                                    | Product Prices                                                 |
| subscription       | `Reference`   | [Reference](#Reference)                                              | Reference to the subscription                                  |
| license            | `?Reference`  | [Reference](#Reference)                                              | Reference to the licence                                       |

#### Program

| Field          | Type              | Example                                            | Description                                  |
|----------------|-------------------|----------------------------------------------------|----------------------------------------------|
| legacyCode     | `string`          | Microsoft                                          | Program legacy code                          | 

#### Identifiers

The Identifiers contain vendor sku of product

| Field            | Type     | Example             | Description |
|------------------|----------|---------------------|-------------|
| vendor           | `Vendor` | [Vendor](#Vendor)   |             |

#### Vendor

| Field | Type     | Example                               | Description |
|-------|----------|---------------------------------------|-------------|
| sku   | `string` | 79C103C3-35E2-4E1F-81BB-AAE69800A3EF  | Vendor SKU  |

#### Prices

| Field           | Type     | Example   | Description                  |
|-----------------|----------|-----------|------------------------------|
| buy             | `float`  | 12.34     | Price the product was bought |
| sell            | `float`  | 56.78     | Price the product was sold   |
| currency        | `string` | EUR       | Currency                     |
| periodicity     | `string` | per Month | product price periodicity    |
| term            | `string` | 1 Year    | Billing term                 |
| periodicityCode | `int`    | 720       | The periodicity code         |
| termCode        | `int`    | 720       | The term code                |

### OrderHistory

Order History is managed by the `OrderHistory` entity

| Field               | Type        | Example                      | Description                               |
|---------------------|-------------|------------------------------|-------------------------------------------|
| orderId             | `string`    | 123456                       | Order ID                                  |
| action              | `string`    | Status changed               | Action on the order                       |
| description         | `string`    | Status changed to: Fulfilled | Description of the action                 |
| user                | `string`    | admin                        | Name of the user that executed the action |
| dateAction          | `string`    | 2022-04-18 18:26:56          | Date the action was executed              |

## Usage

The license client is simply called `OrdersClient`.
You can get it through the main entry point `PublicApiClient` and its method `getOrdersClient()`, or instantiate it
directly.

### getOrders Method

The "getOrders" has been designed to perform a quick search over Order through `PublicAPI` endpoint (GET /orders)
The function accept as parameter [OrdersFilters](#OrdersFilters) where we can specify our filters
The output of the function will be a generator of OrderActions where pagination will be handled automatically

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$payload = [
    'program' => 'MSC',
    'from' => '2024-12-01',
    'sortBy' => 'dateCreation',
    'orderBy' => 'asc',
];
$filter = new OrdersFilters($payload);
$allOrders = $client->getOrders($filter);

foreach ($allOrders as $order){
    echo $order->getOrderReference();
} 
```

### getOrderPage EndPoint

The "getOrderPage" has been designed to perform a quick search over Order through `PublicAPI` endpoint (GET /orders)
The function accept two parameter [OrdersFilters](#OrdersFilters) and `page number` where we can specify our filters and which page we desire
The output of the function will be a GetOrderResponse where we can get data and count

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$payload = [
    'program' => 'MSC',
    'from' => '2024-12-01',
    'sortBy' => 'dateCreation',
    'orderBy' => 'asc',
];

$filter = new OrdersFilters($payload);
$ordersResponse = $client->getOrdersPage($filter, 3);

echo $ordersResponse->getPagination()->getTotal();
echo $ordersResponse->getPagination()->getTotalPage();
echo $ordersResponse->getPagination()->getCurrentPage();

foreach ($ordersResponse->getOrders() as $order){
    echo $order->getOrderReference();
} 
```

### createOrder EndPoint

The "createOrder" has been designed to perform an Order creation through `PublicAPI` endpoint (POST /orders)
The function accept one parameter [CreateOrder](#CreateOrder) and return the reference of new created order

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$payload =[ 
    'scheduledDate' => '2024-12-01',
    'customer' => [
        'reference' => 'test',
        'ponumber' => 'test',
    ],
    'products' => [
        [
            'quantity' => 2,
            'friendlyName' => 'test',
            'arrowSpherePriceBandSku' => 'testArrowsSku',
            'subscription' => [
                'reference' => 'XSPS102',
            ],
        ],
    ],
];
$order = new CreateOrder($payload);
$ref = $client->createOrder($order);
echo  'order has been created successfully '. $ref
```

### getOrder EndPoint

The "getOrder" has been designed to retrieve order based on order reference through `PublicAPI` endpoint (GET /orders/{orderReference})
The function accept one parameter which is order reference and return [Order](#Order)

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$order = $client->getOrder('XSPO12345');
echo  'order has been retrieved successfully '. $order?->getOrderReference();
```

### updateOrder EndPoint

The "updateOrder" has been designed to update existing order through `PublicAPI` endpoint (PATCH /orders/{orderReference})
The function accept two parameters (orderReference and PoNumber)and it will return nothing if it was correctly executed 

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$order = $client->updateOrder('XSPO12345', '1001');
```

### resubmitOrder EndPoint

The "resubmitOrder" has been designed to resubmit existing order (in case of process error) through `PublicAPI`endpoint (PATCH /orders/{orderReference}/resubmit)
The function will accept one parameter which is orderRef and will return nothing if it was correctly executed 

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$order = $client->resubmitOrder('XSPO12345');
```

### cancelOrder EndPoint

The "resubmitOrder" has been designed to cancel existing order (in case of in progress order) through `PublicAPI`
endpoint (PATCH /orders/{orderReference}/cancel)
The function accept 1 parameter: orderRef
The output of the function will be "void"

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$order = $client->cancelOrder('XSPO12345');
```

### validateOrder EndPoint

The "validateOrder" has been designed to validate existing order (in case of order is waiting for validation)
through `PublicAPI` endpoint (PATCH /orders/{orderReference}/validate)
The function accept 1 parameter: orderRef
The output of the function will be "void"

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$order = $client->validateOrder('XSPO12345');
```

### getOrderHistory EndPoint

The "getOrderHistory" has been designed to get Order History through `PublicAPI` endpoint (get /orders/{orderReference}/history)
The function accept 1 parameter: orderRef
The output of the function will be "OrderHistory"

```php
<?php

use ArrowSphere\PublicApiClient\Orders\OrdersClient;
use ArrowSphere\PublicApiClient\Orders\Request\OrdersFilters;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OrdersClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$orderHistories = $client->getOrderHistory('XSPO12345');

foreach ($orderHistories as $orderHistory){
    echo $orderHistory->getAction();
    echo $orderHistory->getDescription();
    echo $orderHistory->getUser();
}
```