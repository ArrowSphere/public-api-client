# Changelog

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.4.5] - 2021-06-30
### Changed
- Rename columns and restructure payloads for Statement and StatementLines
### Added
- Added Prices and Rates entities

## [0.4.4] - 2021-06-29
### Added
- Added name, priority, overrides and filters in Preference entity

## [0.4.3] - 2021-06-25
### Added
- New warnings attribute. Collections of Warning[]
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
- The ```License``` entity has been moved to a sub namespace ```License``` of the ```Entities``` namespace to better sort the entities that have dependencies between them
- The ```License``` entity has been changed to reflect the arborescence of objects returned by the API, so 2 new classes have been created to handle this: ```ActiveSeats``` and ```Price```. See [Upgrade guide](UPGRADING.md#Changes to the license entity)
- The fields that need to be used with the licenses find endpoint must be prefixed. To handle this, use the ```LicenseFindFieldEnum``` consts. See [Upgrade guide](UPGRADING.md#Changes due to the integration of the v2 license endpoint)

### Fixed
- Added indices to the offers and licenses yields because the way they were built generated index reutilization with the default behavior of ```iterator_to_array```

## [0.2.5] - 2021-03-29
### Added
- Added "build lowest version" to the CI workflow, so now the tests are run against both the lowest and the highest dependencies of composer packages
- Added a new "static" workflow to add phpstan and psalm to perform some static-analysis on the codebase
- Added a "checks" workflow to perform some additional checks on the codebase

### Fixed
- The ```LicensesClient``` had a bug: if there were exactly 2 pages of results, the second page was not loaded
- The ```OfferClient``` had the same bug

### Changed
- Changed the Makefile so Psalm runs with the dev dependencies (so it doesn't uninstall them each time we run it)

## [0.2.4] - 2021-02-11
### Added
- The ```FamilyClient``` now has an optional argument named ```$parameters```, in all its methods, to allow adding optional parameters to the URL
- The ```CustomersClient``` has the same optional argument
- The ```CheckDomainClient``` has the same optional argument

### Fixed
- The ```License``` entity now allows ```null``` for the fields ```price.currency```, ```friendlyName```, and ```vendorSubscriptionId```

## [0.2.3] - 2021-02-10
### Added
- Customers client (list and create)

### Fixed
- The ```PublicApiClient::getFamilyClient()``` method has been fixed
- Removed old import in ```CatalogClientTest```, and added phpdoc at class-level for the client used in this test class

## [0.2.2] - 2021-02-01
### Added
- Added support for fields ```add_ons``` and ```prerequisites``` in the ```OfferClient::find``` method

## [0.2.1] - 2021-01-29
### Changed
- Added support to Guzzle 6.0 (in addition to Guzzle 7.2)

## [0.2.0] - 2021-01-28
### Added
- Family client

### Changed
- The ```curl/curl``` dependency has been dropped and replaced by ```guzzlehttp/guzzle``` which is vastly more popular and has more features

### Fixed
- The ```OfferClient::find()``` method now reworks the "filters" field to make sure that when the values are arrays, they are list-arrays and not associative arrays
- The ```LicensesClient::find()``` method now reworks the "filters" and the "values" field of the "keywords" field to make sure that when the values are arrays, they are list-arrays and not associative arrays
- Fixed incorrect payload in the ```LicensesClientTest```

### Deprecated
- ServiceClient: this is the old endpoint, the family client should now be used instead

## [0.1.2] - 2021-01-20
### Fixed
- Bug related to the end customer price

## [0.1.1] - 2021-01-19
### Added
- Monthly analytics: added end customer and list price
- Added a license filter to ```AnalyticsClient::getMonthly()```

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