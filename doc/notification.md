# Notification Client

## _General information_

A notification is the entity which holds information about message sent to users (subject, bodyMessage, if read or not, username related...).
It is identified in ArrowSphere Cloud by a uuid(uuid type, e.g 56f44d73-b851-46c5-8de9-46bbccc57d78).

## _Entities_

### Notification

A Notification is managed by the `Notification` entity.

| Field       | Type     | Example                                      | Description                                                                                                      |
|-------------|----------|----------------------------------------------|------------------------------------------------------------------------------------------------------------------|
| id          | `string` | 81f44d73-b851-46c5-8de9-46bbccc57d66         | The id of the notification                                                                                       |
| userName    | `string` | bob                                          | The username to whom the notification is sent                                                                    |
| subject     | `string` | License Upgrade                              | The name of the subject                                                                                          |
| content     | `string` | Hi, your license was successfully upgrade... | The body message of the notification                                                                             |
| hasBeenRead | `int`    | 0                                            | If the notification is read or unread                                                                            |
| created     | `int`    | 1672060533                                   | The creation date (Timestamp)                                                                                    |
| expires     | `int`    | 1674738933                                   | The expiration date (Set by default to 30 days for msp, for Admin only 7 due to a large amount of notif stocked) |

## _Usage_

The notification client is simply called `NotificationClient`.
You can get it through the main entry point `PublicApiClient` and its method `getNotificationClient()`, or instantiate it directly.

```php
<?php

use ArrowSphere\PublicApiClient\Notification\SupportClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const ACCESS_TOKEN = 'your access token';

$client = (new SupportClient())
    ->setUrl(URL)
    ->setAccessToken(ACCESS_TOKEN);

```

## _Endpoints_

### GetOneNotification

The "getOneNotification" endpoint allows the user to get a specific notification.

The `NotificationClient::getOneNotification()` method returns a `NotificationEntity`.

### ListNotifications

The "listNotifications" endpoint is used in order to list all notifications of a given user.

The `NotificationClient::listNotifications()` method returns an array of `NotificationEntity`.

The QueryParameters enabled for filter result:

| Parameters  | Example                               | Description                                                                                                      |
|-------------|---------------------------------------|------------------------------------------------------------------------------------------------------------------|
| created     | 2022-09-13                            | The date from which you wish to filter the notifications                                                         |
| perPage     | 25                                    | The number of items we want to show per page (default 10, like on notificationCenter page)                       |
| hasBeenRead | true                                  | If we want to show only read or unread notifications in list                                                     |
| searchAfter | 81f44d73-b851-46c5-8de9-46bbccc57d66  | The last notification id in previous list in case of pagination                                                  |

### ReadOneNotification

The "readOneNotification" endpoint is used to update the hasBeenRead fields to true, and so 'read the notification'.

When calling it, it is necessary to specify desired id.

The `NotificationClient::readOneNotification()` method returns a `NotificationEntity`.

### ReadAllNotifications

The "readAllNotifications" endpoint allows the related user to read all his notifications.

The `NotificationClient::readAllNotifications()` method just returns a no content status code response.

### DeleteOneNotification

The "deleteOneNotification" endpoint allows the related user to delete a specific notification.

The `NotificationClient::deleteOneNotification()` method just returns a no content status code response.

### DeleteAllNotifications

The "deleteAllNotifications" endpoint permit the related user to delete all his notifications.

The `NotificationClient::deleteAllNotifications()` method just returns a no content status code response.

### CountNotifications

The "countNotifications" endpoint is used to retrieve the total amount of notification a user has.

The `NotificationClient::CountNotifications()` method returns a string with the total amount result.

The only QueryParameters enabled for filter result is `hasBeenRead` (for count either read or unread notifications, by default if no query parameters is passed the unread's amount are displayed).
