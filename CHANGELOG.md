# Changelog

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.11.12] - 2024-10-23

- Changed property `CustomerPrices.value` to `CustomerPrices.fixedPrice`
- Updated property `CustomerPrices.customer` to be not mandatory
- Add properties `Prices.arrow` and `Prices.partner`

## [0.11.11] - 2024-09-18

- Added proprty `Item.coterminosityDate`

## [0.11.10] - 2024-09-17

- Updated `CustomerPrices` value is optional

## [0.11.9] - 2024-09-16

- Fixed `QuotesClient::create` add `parameters` and `headers` as default params

## [0.11.8] - 2024-09-12

- Fixed `CreateQuote` items initial value

## [0.11.7] - 2024-09-11

- Fixed `PublicApiClient` adds missing method getQuotesClient

## [0.11.6] - 2024-09-11

- Fixed `CreateQuote` items is optional

## [0.11.5] - 2024-09-06

- Added new client `getQuotesClients` to manage Quotes
- Added new method `create` to create a quote
  s

## [0.11.4] - 2024-09-04

- Update minimum PHP version to 8.0
- Update PhpStan & Psalm & PhpCsFixer to the latest version
- Fix Psalm issues
- Added new client `OrdersClients` to manage Orders
- Added new method `getOrders` to get all orders
- Added new method `getOrdersPage` to get orders per page
- Added new method `createOrder` to create new order
- Added new method `getOrder` to get order by ref
- Added new method `updateOrder` to update order POnumber
- Added new method `resubmitOrder` to resubmit order
- Added new method `cancelOrder` to cancel an order
- Added new method `validateOrder` to validate an order
- Added new method `getOrderHistory` to get order history
- Added new Entity `AbstractEntity` to build request payload as an object

## [0.11.3] - 2024-09-02

- Added GDAP endpoints to the Customer client

## [0.11.2] - 2024-06-12

- Added a method `postReconciliation` to `CustomersClient` to trigger the mass reconciliation process for end customers

## [0.11.1] - 2024-04-08

- Added a dedicated User-Agent header to the `PublicApiClient` requests
- Added optional `includeAssets` bool parameter to `CampaignsClient::getCampaignV2()` and
  `CampaignsClient::getCampaignV2Raw()` to allow these methods to return campaigns asset's URLs.
- Updated `CampaignV2` entity to add downloadable assets field

## [0.11.0] - 2024-03-28

- Added support of access tokens in all clients
- Added magic getters in `PublicApiClient` to instantiate all clients without adding a new method each time
- Fixed various typos in the documentation
- Removed the specific header management from cart and notification clients (now doing this in a generic way)
- `SupportClient::addAttachment()` now returns an `int` (the attachment id)
- Removed the 4 support clients classes (`AttachmentClient`, `CommentClient`, `IssueClient` and `TopicClient`) and moved their code to `SupportClient`

## [0.10.14] - 2023-12-11

- Fix Offer entity: default value for isAutoRenew and isManualProvisioning

## [0.10.13] - 2023-10-02

- Add support of searchAfter for get licenses list

## [0.10.12] - 2023-07-12

- Fixed bugs on customers data handling.

## [0.10.11] - 2023-07-04

- Fix pagination for the get customers list and get organization units list endpoints.
- Fix url and result in customer update endpoint.

## [0.10.10] - 2023-06-06

### Added

- Added a new client `PartnersClient` to manage organization unit
- Updated `Customer` entity to add organization unit field

## [0.10.9] - 2023-04-20

## [0.10.5] - 2023-04-18

### Added

- Added a new Abstract named `AbstractCartClient` to manage the impersonate option with `AbstractCartClient::prepareHeaders()`in order to set the username we want to impersonate.

## [0.10.8] - 2023-03-27

- Manage total Price on `Price` object

## [0.10.7] - 2023-03-23

- Add const `LicenseFindFieldEnum::LICENSE_CUSTOMER_VENDOR_REF`
- Manage unit Price on `Price` object

## [0.10.6] - 2023-03-23

- Fix cast for `customerVendorRef` attribute on license entity

## [0.10.5] - 2023-03-22

- Add `customerVendorRef` attribute on license entity

## [0.10.4] - 2023-03-02

### Changed

- edit method `IssueClient::closeIssue()` to not return a value and just do the patch update request

## [0.10.3] - 2023-02-22

### Added

- Added a new entity named `predictionResponse` to reflect the predictions which is data that can be used to anticipate and plan for future consumption demand .
- Added a new entity named `Predictions` to reflect the prediction endpoint paylaod structure .
- Added a new method named `LicenseClient::getPredictions()` in order to get Predictions for API Endpoint .

## [0.10.2] - 2023-02-16

- Add a new client named `ErpExportsClient` for billing ERP export, its entities and its tests.

## [0.10.1] - 2023-02-15

### Changed

- Check on method `NotificationClient::createNotification()` to ensure that if the username field is passed by mistake in the header it is not taken into account.
- Refacto on method `CommentClient::listAllComments()` to ensure good performance and apply good practice.

## [0.10.0] - 2023-02-09

### Added

- Added a new client named `CartClient` in order to manage all actions related to the cart.
- Added a new client named `NotificationClient` for handle all actions related to the screen notifications.
- Added a new client named `SupportClient` to manage all actions related to the cart.

## [0.9.7] - 2023-01-31

### Added

- Added new entity `Security`
- Added new property `security` to License entity which is a type of `Security` class.
- Added Enum `LICENSE_SECURITY` to `LicenseFindFieldEnum` class.

## [0.9.6] - 2022-11-15

### Added

- Added a new entity named `CampaignV2` to reflect the new Campaign layout. This entity comes with V2 version of the entities `LandingPage`, `LandingPageFooter` and `LandingPageFeature` as the last one have changed too.
- Added a new entity named `LandingPageFeatureItem` called by `LandingPageFeatureV2`.
- Added a new entity named `LandingPageMarketingFeature` called by `LandingPageFooterV2`.
- Added a new entity named `LandingPageMarketingFeatureItem` called by `LandingPageMarketingFeature`.
- Added a new method `CampaignsClient::getActiveCampaigns()` due to the changes in the API: we know are getting every active campaigns for a user when calling a v2.
- Added a new method `CampaignsClient::getCampaignV2()` giving the new version of Campaigns for a single campaign.

### Changed

- Reorganization of the order of the methods in `CampaignsClient` for better clarity when you're reading this file.
- The method `CampaignsClient::getCampaigns()` is now returning a Generator|CampaignV2\[] instead of Generator|Campaign\[]

## [0.9.5] - 2022-10-04

### Changed

- Changed overridden method `JsonSerializable::jsonSerialize()`, add return type

## [0.9.4] - 2022-08-11

### Added

- Added the `License::$vendorBillingId` attribute (as `string|null`) to manage this new vendor-specific field
- Added policy value for customer invitation entity

### Changed

- Changed method `CustomersClient::createInvitation()`, add parameter `$policy` to pass more information

## [0.9.3] - 2022-06-30

### Added

- Added status value 'Rejected' for Billing Statement entity

### Changed

- Changed `Statement::$billingStrategy` attribute to be null if not in the API payload

## [0.9.2] - 2022-05-31

### Added

- Added new methods getActiveCampaignRawV2 and getActiveCampaignV2 which will replace getActiveCampaignRaw (deprecated) and getActiveCampaignRaw (deprecated)

### Deprecated

- getActiveCampaignRaw: this is the old method get active campaign in raw mode, the getActiveCampaignRawV2 should now be used instead
- getActiveCampaign: this is the old method get active campaign, the getActiveCampaignV2 should now be used instead

## [0.9.1] - 2022-03-24

### Changed

- Added support for PHP 8.1 in the CI

### Fixed

- Added a default `Content-Type` header as `application/json` to all the calls

### Added

- Added methods to manage invitations to the customer portal.

## [0.9.0] - 2022-03-02

### Added

- Added `programCode` attribute in the Billing Statement entity

### Changed

- Renamed `vendorProgram` to `programCode` in the Billing Statement Line entity

## [0.8.0] - 2022-01-13

### Added

- Added `status`, `billingStrategy` and `sequence` attributes in the Billing Statement entity
- Added `StatementsClient::postExport()` return value

### Changed

- Changed `StatementsClient::getStatements()` and `StatementsClient::getStatementsRaw()` parameters
- Changed `StatementsClient::postExport()` parameters

### Fixed

- Fixed null rate type and null rate value in the Billing Rates entity
- Fixed allow using `setPerPage` for `StatementsClient::getStatements()` and `StatementsClient::getStatementLines()`

### Removed

- Removed `billingStatementId` and `billingPreference` attributes from the Billing Statement entity

### Fixed

- Fixed the UPGRADING.md documentation to add exactly what breaking changes each version brings.

## [0.7.2] - 2021-12-02

### Added

- Added a getter to `AnalyticsClient` and `HealthCheckClient` from `PublicApiClient`

## [0.7.1] - 2021-11-19

### Added

- Added `sell_price` property in license's prices in `LicensesClient`

## [0.7.0] - 2021-11-16

### Fixed

- Added the missing background color to the banner entity
- Added the customer reference to get an active campaign

## [0.6.3] - 2021-10-18

### Added

- Adding new fields to the Landing Page to be able to use the Form type.

### Fixed

- Fixed a typo in the Landing Page Body documentation.

## [0.6.2] - 2021-10-04

### Fixed

- Fixed workflows for semi-automatic publishing

## [0.6.1] - 2021-09-29

### Added

- Added `arrowSubCategories` property in offer object response.

### Fixed

- Fixed the changelog's version links at the bottom

### Changed

- Changed the release GitHub action so it goes through branches and pull requests, to avoid pushing directly to master (which is often prohibited)

## [0.6.0] - 2021-09-27

### Added

- Added a new GitHub action to automate part of the release process
- Added the entities for the campaign assets: `Asset`, `AssetImage`, `AssetImageFields` and `AssetUploadUrl`, along with their unit tests

### Fixed

- Reformatted the markdown files

### Changed

- The method `CampaignClient::getCampaignAssets()` has been renamed to `CampaignClient::getCampaignAssetsRaw()`
- The method `CampaignClient::getCampaignAssetsUploadUrl()` has been renamed to `CampaignClient::getCampaignAssetsUploadUrlRaw()`

## [0.5.0] - 2021-09-24

### Added

- Add the `isActivated` var for the `Campaign` entity.
- Add the `getActiveCampaign()` method in the `CampaignsClient` class
- Added tests for Campaigns entities and for some methods of the client

### Changed

- The method `CampaignClient::getCampaigns()` has been renamed to `CampaignClient::getCampaignsRaw()` to be more coherent with the other clients

## [0.4.15] - 2021-09-17

### Added

- Added `description` property and `getDescription()` method to `Statement` class

## [0.4.14] - 2021-09-14

### Added

- Added a `setDefaultHeaders()` method in the `AbstractClient` class to support specific headers
- Added a `getCampaignsClient()` method to get the campaigns client

## [0.4.13] - 2021-09-06

### Added

- Add a new client for Campaigns and its Entities
- Add the `delete` & `put` functions in `AbstractClient`

## [0.4.12] - 2021-08-12

### Added

- Add a new filter for billing/export, using array of statements references

## [0.4.11] - 2021-08-03

### Changed

- change CustomerName filter for billing/export (use array for multiple values)

### Added

- new filters for billing/export (support array of customer references)

## [0.4.10] - 2021-07-28

### Changed

- Remove periodFrom/periodTo parameters for BillingStatements

### Added

- Added new filters parameters for BillingStatements endpoint
- Enum for Tier and Format values
- New endpoint '/export' support

## [0.4.9] - 2021-07-22

### Added

- add billingStatementId and billingPreference columns for Billing Statements

### Changed

- Update preference documentation

## [0.4.8] - 2021-07-06

### Changed

- Rename columns and restructure payloads for Statement and StatementLines

### Added

- Added Prices and Rates entities

## [0.4.7] - 2021-07-02

### Changed

- Rename excludingFilters by exclusionFilters search query

## [0.4.6] - 2021-07-01

### Added

- Added description in StatementLine entity

## [0.4.5] - 2021-07-01

### Added

- New getWarnings() method on license entity
- New enum LICENSE_WARNINGS
- New excludingFilters search query

## [0.4.4] - 2021-06-29

### Added

- Added name, priority, overrides and filters in Preference entity

## [0.4.3] - 2021-06-25

### Added

- New warnings attribute. Collections of Warning\[]
- Enrichment License.jsonSerialize() output

### Changed

- Update licenses.md - Enrichment License object

## [0.4.2] - 2021-06-17

### Removed

- Removed unused attributes from StatementLine entity

### Changed

- Allow nullable values in some StatementLine entity attributes

## [0.4.1] - 2021-06-14

### Added

- Added compare between two fields in license client

## [0.4.0] - 2021-06-09

### Added

- Billing Statement Client
- Billing Preferences Client

## [0.3.1] - 2021-05-18

### Added

- Added method in Licenses Client to retrieve existing licenses configurations for specific customer
- Added method in Licenses Client to create/update specific configuration

## [0.3.0] - 2021-05-11

### Changed

- Adapted the code to handle the new /licenses/find v2 endpoint, which implicate several breaking changes (see below)
- The `License` entity has been moved to a sub namespace `License` of the `Entities` namespace to better sort the entities that have dependencies between them
- The `License` entity has been changed to reflect the arborescence of objects returned by the API, so 2 new classes have been created to handle this: `ActiveSeats` and `Price`. See [Upgrade guide]\(UPGRADING.md#Changes to the license entity)
- The fields that need to be used with the licenses find endpoint must be prefixed. To handle this, use the `LicenseFindFieldEnum` consts. See [Upgrade guide]\(UPGRADING.md#Changes due to the integration of the v2 license endpoint)

### Fixed

- Added indices to the offers and licenses yields because the way they were built generated index reutilization with the default behavior of `iterator_to_array`

## [0.2.5] - 2021-03-29

### Added

- Added "build lowest version" to the CI workflow, so now the tests are run against both the lowest and the highest dependencies of composer packages
- Added a new "static" workflow to add phpstan and psalm to perform some static-analysis on the codebase
- Added a "checks" workflow to perform some additional checks on the codebase

### Fixed

- The `LicensesClient` had a bug: if there were exactly 2 pages of results, the second page was not loaded
- The `OfferClient` had the same bug

### Changed

- Changed the Makefile so Psalm runs with the dev dependencies (so it doesn't uninstall them each time we run it)

## [0.2.4] - 2021-02-11

### Added

- The `FamilyClient` now has an optional argument named `$parameters`, in all its methods, to allow adding optional parameters to the URL
- The `CustomersClient` has the same optional argument
- The `CheckDomainClient` has the same optional argument

### Fixed

- The `License` entity now allows `null` for the fields `price.currency`, `friendlyName`, and `vendorSubscriptionId`

## [0.2.3] - 2021-02-10

### Added

- Customers client (list and create)

### Fixed

- The `PublicApiClient::getFamilyClient()` method has been fixed
- Removed old import in `CatalogClientTest`, and added phpdoc at class-level for the client used in this test class

## [0.2.2] - 2021-02-01

### Added

- Added support for fields `add_ons` and `prerequisites` in the `OfferClient::find` method

## [0.2.1] - 2021-01-29

### Changed

- Added support to Guzzle 6.0 (in addition to Guzzle 7.2)

## [0.2.0] - 2021-01-28

### Added

- Family client

### Changed

- The `curl/curl` dependency has been dropped and replaced by `guzzlehttp/guzzle` which is vastly more popular and has more features

### Fixed

- The `OfferClient::find()` method now reworks the "filters" field to make sure that when the values are arrays, they are list-arrays and not associative arrays
- The `LicensesClient::find()` method now reworks the "filters" and the "values" field of the "keywords" field to make sure that when the values are arrays, they are list-arrays and not associative arrays
- Fixed incorrect payload in the `LicensesClientTest`

### Deprecated

- ServiceClient: this is the old endpoint, the family client should now be used instead

## [0.1.2] - 2021-01-20

### Fixed

- Bug related to the end customer price

## [0.1.1] - 2021-01-19

### Added

- Monthly analytics: added end customer and list price
- Added a license filter to `AnalyticsClient::getMonthly()`

## [0.1.0] - 2021-01-18

### Added

- General clients (Whoami, Check domain)
- Catalog clients (Classification, Program, Service, Offer, Addon)
- Consumption client (Health Check, Monthly Analytics)
- Licenses Client (Licenses, to perform the "find" operation like the Offer client)
- Customers Client (Customers, to get the list of the end customers)

### Deprecated

- CatalogClient: this is an old client that contained way too many endpoints
- AddonClient: the addons should not be differencied with the offers
- Entity Price: use PriceBand now, which is in the Catalog namespace where it belongs
- Entity Service: the root entity is deprecated, and the one in the Catalog namespace should be used

[Unreleased]: https://github.com/ArrowSphere/public-api-client/compare/0.11.12...HEAD
[0.11.12]: https://github.com/ArrowSphere/public-api-client/compare/0.11.11...0.11.12
[0.11.11]: https://github.com/ArrowSphere/public-api-client/compare/0.11.10...0.11.11
[0.11.10]: https://github.com/ArrowSphere/public-api-client/compare/0.11.9...0.11.10
[0.11.9]: https://github.com/ArrowSphere/public-api-client/compare/0.11.8...0.11.9
[0.11.8]: https://github.com/ArrowSphere/public-api-client/compare/0.11.7...0.11.8
[0.11.7]: https://github.com/ArrowSphere/public-api-client/compare/0.11.6...0.11.7
[0.11.6]: https://github.com/ArrowSphere/public-api-client/compare/0.11.5...0.11.6
[0.11.5]: https://github.com/ArrowSphere/public-api-client/compare/0.11.4...0.11.5
[0.11.4]: https://github.com/ArrowSphere/public-api-client/compare/0.11.3...0.11.4
[0.11.3]: https://github.com/ArrowSphere/public-api-client/compare/0.11.2...0.11.3
[0.11.2]: https://github.com/ArrowSphere/public-api-client/compare/0.11.1...0.11.2
[0.11.1]: https://github.com/ArrowSphere/public-api-client/compare/0.11.0...0.11.1
[0.11.0]: https://github.com/ArrowSphere/public-api-client/compare/0.10.14...0.11.0
[0.10.14]: https://github.com/ArrowSphere/public-api-client/compare/0.10.13...0.10.14
[0.10.13]: https://github.com/ArrowSphere/public-api-client/compare/0.10.12...0.10.13
[0.10.12]: https://github.com/ArrowSphere/public-api-client/compare/0.10.11...0.10.12
[0.10.11]: https://github.com/ArrowSphere/public-api-client/compare/0.10.10...0.10.11
[0.10.10]: https://github.com/ArrowSphere/public-api-client/compare/0.10.9...0.10.10
[0.10.9]: https://github.com/ArrowSphere/public-api-client/compare/0.10.8...0.10.9
[0.10.8]: https://github.com/ArrowSphere/public-api-client/compare/0.10.7...0.10.8
[0.10.7]: https://github.com/ArrowSphere/public-api-client/compare/0.10.6...0.10.7
[0.10.6]: https://github.com/ArrowSphere/public-api-client/compare/0.10.5...0.10.6
[0.10.5]: https://github.com/ArrowSphere/public-api-client/compare/0.10.4...0.10.5
[0.10.4]: https://github.com/ArrowSphere/public-api-client/compare/0.10.3...0.10.4
[0.10.3]: https://github.com/ArrowSphere/public-api-client/compare/0.10.2...0.10.3
[0.10.2]: https://github.com/ArrowSphere/public-api-client/compare/0.10.1...0.10.2
[0.10.1]: https://github.com/ArrowSphere/public-api-client/compare/0.10.0...0.10.1
[0.10.0]: https://github.com/ArrowSphere/public-api-client/compare/0.9.7...0.10.0
[0.9.7]: https://github.com/ArrowSphere/public-api-client/compare/0.9.6...0.9.7
[0.9.6]: https://github.com/ArrowSphere/public-api-client/compare/0.9.5...0.9.6
[0.9.5]: https://github.com/ArrowSphere/public-api-client/compare/0.9.4...0.9.5
[0.9.4]: https://github.com/ArrowSphere/public-api-client/compare/0.9.3...0.9.4
[0.9.3]: https://github.com/ArrowSphere/public-api-client/compare/0.9.2...0.9.3
[0.9.2]: https://github.com/ArrowSphere/public-api-client/compare/0.9.1...0.9.2
[0.9.1]: https://github.com/ArrowSphere/public-api-client/compare/0.9.0...0.9.1
[0.9.0]: https://github.com/ArrowSphere/public-api-client/compare/0.8.0...0.9.0
[0.8.0]: https://github.com/ArrowSphere/public-api-client/compare/0.7.2...0.8.0
[0.7.2]: https://github.com/ArrowSphere/public-api-client/compare/0.7.1...0.7.2
[0.7.1]: https://github.com/ArrowSphere/public-api-client/compare/0.7.0...0.7.1
[0.7.0]: https://github.com/ArrowSphere/public-api-client/compare/0.6.3...0.7.0
[0.6.3]: https://github.com/ArrowSphere/public-api-client/compare/0.6.2...0.6.3
[0.6.2]: https://github.com/ArrowSphere/public-api-client/compare/0.6.1...0.6.2
[0.6.1]: https://github.com/ArrowSphere/public-api-client/compare/0.6.0...0.6.1
[0.6.0]: https://github.com/ArrowSphere/public-api-client/compare/0.5.0...0.6.0
[0.5.0]: https://github.com/ArrowSphere/public-api-client/compare/0.4.15...0.5.0
[0.4.15]: https://github.com/ArrowSphere/public-api-client/compare/0.4.14...0.4.15
[0.4.14]: https://github.com/ArrowSphere/public-api-client/compare/0.4.13...0.4.14
[0.4.13]: https://github.com/ArrowSphere/public-api-client/compare/0.4.12...0.4.13
[0.4.12]: https://github.com/ArrowSphere/public-api-client/compare/0.4.11...0.4.12
[0.4.11]: https://github.com/ArrowSphere/public-api-client/compare/0.4.10...0.4.11
[0.4.10]: https://github.com/ArrowSphere/public-api-client/compare/0.4.9...0.4.10
[0.4.9]: https://github.com/ArrowSphere/public-api-client/compare/0.4.8...0.4.9
[0.4.8]: https://github.com/ArrowSphere/public-api-client/compare/0.4.7...0.4.8
[0.4.7]: https://github.com/ArrowSphere/public-api-client/compare/0.4.6...0.4.7
[0.4.6]: https://github.com/ArrowSphere/public-api-client/compare/0.4.5...0.4.6
[0.4.5]: https://github.com/ArrowSphere/public-api-client/compare/0.4.4...0.4.5
[0.4.4]: https://github.com/ArrowSphere/public-api-client/compare/0.4.3...0.4.4
[0.4.3]: https://github.com/ArrowSphere/public-api-client/compare/0.4.2...0.4.3
[0.4.2]: https://github.com/ArrowSphere/public-api-client/compare/0.4.1...0.4.2
[0.4.1]: https://github.com/ArrowSphere/public-api-client/compare/0.4.0...0.4.1
[0.4.0]: https://github.com/ArrowSphere/public-api-client/compare/0.3.1...0.4.0
[0.3.1]: https://github.com/ArrowSphere/public-api-client/compare/0.3.0...0.3.1
[0.3.0]: https://github.com/ArrowSphere/public-api-client/compare/0.2.5...0.3.0
[0.2.5]: https://github.com/ArrowSphere/public-api-client/compare/0.2.4...0.2.5
[0.2.4]: https://github.com/ArrowSphere/public-api-client/compare/0.2.3...0.2.4
[0.2.3]: https://github.com/ArrowSphere/public-api-client/compare/0.2.2...0.2.3
[0.2.2]: https://github.com/ArrowSphere/public-api-client/compare/0.2.1...0.2.2
[0.2.1]: https://github.com/ArrowSphere/public-api-client/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/ArrowSphere/public-api-client/compare/0.1.2...0.2.0
[0.1.2]: https://github.com/ArrowSphere/public-api-client/compare/0.1.1...0.1.2
[0.1.1]: https://github.com/ArrowSphere/public-api-client/compare/0.1.0...0.1.1
[0.1.0]: https://github.com/ArrowSphere/public-api-client/compare/377de97b5429567a9632338418caa341ab3094f7...0.1.0
