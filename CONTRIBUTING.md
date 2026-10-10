# ArrowSphere Cloud public-api-client package

## Adding a new client

To add a new client, write a new class extending ```AbstractClient```, and:

- set the ```$basePath``` variable which is the main path for your API (ex. /customers)
- set the ```$path``` variable depending on the endpoint you want to call, ```$path``` will be concatenated to ```$basePath``` when requesting your endpoint
- create a method for each endpoint, using the ```get()```, ```post()```, ```patch()```, ```put()``` or ```delete()``` method from AbstractClient
- for an endpoint returning data, provide two methods: ```getFooRaw()``` returning the raw JSON response, and ```getFoo()``` returning entities built from it
- make the new client reachable from ```PublicApiClient``` by adding its ```@method``` annotation

The url of your API is not defined in this project but by the program using the package with the ```setUrl()``` method.

New entities extend ```ArrowSphere\PublicApiClient\Entities\AbstractEntity``` and declare their fields with the ```#[Property]``` attribute.

## Documenting a client

Each client is documented in a page of the ```doc``` directory, linked from the README. Describe the entities, then each method with a short example.

## Before opening a pull request

- add tests in the ```tests``` directory, following the existing ones: one test checking the URL called by the raw method, one with an invalid response, and one checking the returned entities
- run the tests with ```make test``` and the static checks with ```make static```
- add a line describing your change under ```## [Unreleased]``` in ```CHANGELOG.md```, this is enforced by the CI
- if your change breaks backward compatibility, describe how to migrate under ```## Unreleased``` in ```UPGRADING.md```
