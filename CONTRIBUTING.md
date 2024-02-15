# ArrowSphere Cloud public-api-client package

## Adding a new client

To add a new client, write a new class extending ```AbstractClient```, and:

- set the ```$basePath``` variable witch is the main path for your API (ex. /customers)
- set the ```$path``` variable depending on the endpoint you want to call, ```$path``` will be concatenated to ```$basePath``` when requesting your endpoint
- create any function you want to call your endpoints, using method ```get()``` or ```post()``` from AbstractClient

The url of your API is not defined in this project but by the program using the package with the ```setUrl()``` method.
