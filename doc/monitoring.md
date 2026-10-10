# Monitoring Client

## General information

The monitoring client is used to log report (like csp violation).

## Entities

### Report

A report is managed by the `Report` entity.

| Field     | Type     | Example                | Description               |
|-----------|----------|------------------------|---------------------------|
| body      | `Array`  | ["blockedURL"=> 'xxx'] | content of the report     |
| type      | `string` | "csp-violation"        | type of report            |
| url       | `string` | "xxx/home"             | link where report emitted |
| userAgent | `string` | "chrome"               | browser user agent        |

## Usage

You can get it through the main entry point `PublicApiClient` and its method `getMonitoringClient()`, or instantiate it directly as follows:

```php
<?php

use ArrowSphere\PublicApiClient\Monitoring\MonitoringClient;
use ArrowSphere\PublicApiClient\Monitoring\Request\Report;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new MonitoringClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$client->sendReport([
    new Report([
        'body'      => ['blockedURL' => 'xxx'],
        'type'      => 'csp-violation',
        'url'       => 'xxx/home',
        'userAgent' => 'chrome',
    ]),
]);
```

The `MonitoringClient::sendReport()` method sends the given reports in a single request and returns `true`.