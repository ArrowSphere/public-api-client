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

const URL = 'https://your-url-to-arrowsphere.example.com

$client = (new MonitoringClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);


$report = $client->createReport([new Report([ 
    'body' => ["blockedURL"=> 'xxx'],
    'type' => "csp-violation",
    'url' => "xxx/home",
    'userAgent' => "chrome"
])]);
```