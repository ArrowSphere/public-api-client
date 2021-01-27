# Changelog

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.1.3] - 2021-01-25
### Added
- Family client

### Changed
- The ```curl/curl``` dependency has been dropped and replaced by ```guzzlehttp/guzzle``` which is vastly more popular and has more features

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

### Deprecated
- CatalogClient: this is an old client that contained way too many endpoints
- AddonClient: the addons should not be differencied with the offers
- Entity Price: use PriceBand now, which is in the Catalog namespace where it belongs
- Entity Service: the root entity is deprecated, and the one in the Catalog namespace should be used
