# Cart Client

## _General information_

A cart is the entity which holds information about the customer's cart.
It is identified in ArrowSphere Cloud by its related username and item id (uuid type, e.g 81f44d73-b851-46c5-8de9-46bbccc57d66).

## _Entities_

### Cart

A cart is managed by the `Cart` entity.

| Field                   | Type               | Example                                       | Description                                         |
|-------------------------|--------------------|-----------------------------------------------|-----------------------------------------------------|
| itemId                  | `string`           | 81f44d73-b851-46c5-8de9-46bbccc57d66          | The id of the cart item                             |
| userName                | `string`           | bob                                           | The username who owns the cart                      |
| offerName               | `string`           | Microsoft 365 Business Premium                | The name of the product offer                       |
| priceBandArrowsphereSku | `string`           | 031C9E47-4802-4248-838E-778FB1D2CC05          | The sku related to the ArrowSphere price band       |
| quantity                | `int`              | 5                                             | Indicates the quantity of items                     |
| additionalData          | `AdditionalData[]` | an array of [AdditionalData](#AdditionalData) | Depend of context, some additional data to be added |


### AdditionalData

The additionalData represent the some additional information to be added to the cart item. Depending on vendor and offer.

| Field | Type     | Example      | Description                      |
|-------|----------|--------------|----------------------------------|
| name  | `string` | resellerRate | The name of the data to be added |
| value | `string` | 5.04934      | The value of the additional data |


### PostData

All the data you can passed for POST|PATCH requests:

| Field                   | Type               | Example                                        | Description                                         | Required |
|-------------------------|--------------------|------------------------------------------------|-----------------------------------------------------|----------|
| offerName               | `string`           | Microsoft 365 Business Premium                 | The name of the product offer                       | true     |
| priceBandArrowsphereSku | `string`           | 031C9E47-4802-4248-838E-778FB1D2CC05           | The sku related to the ArrowSphere price band       | true     |
| quantity                | `int`              | 5                                              | Indicates the quantity of items                     | true     |
| additionalData          | `AdditionalData[]` | an array of [AdditionalData](#AdditionalData)  | Depend of context, some additional data to be added | false    |

## _Usage_

The cart client is simply called `CartClient`.
You can get it through the main entry point `PublicApiClient` and its method `getCartClient()`, or instantiate it directly.

```php
<?php

use ArrowSphere\PublicApiClient\Cart\CartClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const ACCESS_TOKEN = 'your access token';

$client = (new CartClient())
    ->setUrl(URL)
    ->setIdToken(ACCESS_TOKEN);

```

## _Endpoints_

### AddCartItem

The "addCartItem" endpoint has been designed specifically to create and add an item for the user cart.

The [PostData](#PostData) is supposed to contain offerName, priceBandArrowsphereSku and quantity at least (additionalData is an optional field)

The `CartClient::addCartItem()` method returns a `CartEntity`.

### PatchUpdateOneCartItem

The "PatchUpdateOneCartItem" endpoint is used to update a specific item in user cart.

When calling it, it is necessary to specify desired itemId.

The [PostData](#PostData) is supposed to contain offerName, priceBandArrowsphereSku and quantity at least (additionalData is an optional field)

The `CartClient::patchUpdateOneCartItem()` method returns a `CartEntity`.

### ListCartItems

The "ListCartItems" endpoint is used in order to list all items owns by a user in his cart.

The `CartClient::listCartItems()` method returns an array of `CartEntity`.

### RemoveOneCartItem

The "RemoveOneCartItem" endpoint allows the related user to remove a specific item in his cart.

The `CartClient::removeOneCartItem()` method just returns a no content status code response.

### EmptyCart

The "EmptyCart" endpoint permit the related user to empty his cart in order to remove all items in it.

The `CartClient::EmptyCart()` method just returns a no content status code response.
