# Support Client

## _General information_

A support is the entity which holds actions and informations about issues in arrowshere, with this client we can create an issue, add comments, attachments and they are attached to different topics.
It is identified in ArrowSphere by it user's apiKey.

## _Entities_

### Issue

A Issue is managed by the `Issue` entity.

| Field          | Type             | Example                                                   | Description                                                                                                      |
|----------------|------------------|-----------------------------------------------------------|------------------------------------------------------------------------------------------------------------------|
| id             | `int`            | 12345                                                     | The id of the issue                                                                                              |
| title          | `string`         | Platform issue How to reset my Microsoft Password ?       | The title issue                                                                                                  |
| topicId        | `int`            | 1                                                         | The id of the related support topic                                                                              |
| description    | `string`         | Hi, I would Like to reset my password, how can I do this? | Description of the issue reported                                                                                |
| endCustomerRef | `string`         | XSP12345                                                  | The ref of the endCustomer                                                                                       |
| language       | `string`         | en                                                        | Language used for communicate issue                                                                              |
| offer          | `Offer`          | [Offer](#Offer)                                           | Offer concerned by issue                                                                                         |
| priority       | `int`            | 2                                                         | Level of issue priority                                                                                          |
| status         | `CreatedBy`      | [CreatedBy](#CreatedBy)                                   | User related to issue                                                                                            |
| createdBy      | `int`            | 1674738933                                                | The expiration date (Set by default to 30 days for msp, for Admin only 7 due to a large amount of notif stocked) |
| supportPlan    | `SupportPlan`    | [SupportPlan](#SupportPlan)                               | Support plan the user subscribed                                                                                 |
| program        | `string`         | MSCSP                                                     | Program related to offer                                                                                         |
| additionalData | `AdditionalData` | [AdditionalData](#AdditionalData)                         | Addotional data add in specific context                                                                          |
| created        | `string`         | 2020-02-01T19:00:00.000Z                                  | The creation date                                                                                                |
| updated        | `string`         | 2020-02-03T15:00:00.000Z                                  | The updated date                                                                                                 |

### Offer

The Offer represent the some information about offer impact by issue.

| Field       | Type     | Example                                                    | Description         |
|-------------|----------|------------------------------------------------------------|---------------------|
| sku         | `string` | 031C9E47-4802-4248-838E-778FB1D2CC05                       | Related sku product |
| name        | `string` | Office 365 Business Essentials                             | Offer name          |
| vendor      | `string` | Microsoft                                                  | Vendor name         |


### CreatedBy

It gives information about the user who is reporting the issue.

| Field     | Type     | Example                  | Description                       |
|-----------|----------|--------------------------|-----------------------------------|
| email     | `string` | Gunn.Wærsted@telenor.com | The communication contact email   |
| firstName | `string` | Gunn                     | Firstname of the contact          |
| lastName  | `string` | Wærsted                  | Last name of the contact          |
| phone     | `string` | 408-867-5309             | Phone number of the contact       |


### SupportPlan

It serve in related support plan information the user subscribes.

| Field        | Type     | Example                      | Description                             |
|--------------|----------|------------------------------|-----------------------------------------|
| label        | `string` | Premium End Customer Support | Label of the support plan               |
| sku          | `string` | ARWMS-ECSUP-PREM-GOLD        | Specific sku of the support plan        |
| sourcePortal | `string` | Arrowsphere                  | Source portal of the support plan       |


### AdditionalData

The additionalData represent the some additional information to be added to the Issue item.

| Field | Type     | Example                                        | Description                      |
|-------|----------|------------------------------------------------|----------------------------------|
| name  | `string` | endCustomerDomainName                          | The name of the data to be added |
| value | `string` | myendcustomerdomainename@onmicrosoft.com       | The value of the additional data |


### Topics

It represents the information for the related topic.

| Field          | Type       | Example                       | Description                                                                                  |
|----------------|------------|-------------------------------|----------------------------------------------------------------------------------------------|
| id             | `int`      | 1                             | Topic identifier                                                                             |
| name           | `string`   | platformIssue                 | Topic name                                                                                   |
| label          | `string`   | Microsoft platform issue      | Topic label                                                                                  |
| premium        | `boolean`  | true                          | Whether the topic is premium or not                                                          |
| description    | `string`   | Arrowsphere                   | Our experts will cross-reference your designs and solutions against Microsoft best practices |


### Attachment

It serve for store all attachments a user posts for a related issue.

| Field          | Type     | Example                                                                                          | Description                            |
|----------------|----------|--------------------------------------------------------------------------------------------------|----------------------------------------|
| fileName       | `string` | capture.png                                                                                      | Name of the attachment file            |
| mimeType       | `string` | image/png                                                                                        | Specific Format of the attachment file |
| content        | `string` | iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+P+/HgAFhAJ/wlseKgAAAABJRU5ErkJggg== | Encrypted content image                |


### Comment

It serve for register all comments a user posts for a related issue.

| Field          | Type        | Example                                                                     | Description                             |
|----------------|-------------|-----------------------------------------------------------------------------|-----------------------------------------|
| body           | `string`    | Hi Zendesk, I would like to reset my Microsoft password, how can I do this? | Body message of the user comment posted |
| createdBy      | `CreatedBy` | [CreatedBy](#CreatedBy)                                                     | Specific sku of the support plan        |


## _Usage_

The support client is simply called `SupportClient`.
You can get it through the main entry point `PublicApiClient` and its method `getSupportClient()`, or instanciate it directly.

```php
<?php

use ArrowSphere\PublicApiClient\Notification\SupportClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API Key for autenticate';

$client = (new SupportClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

```


## _Endpoints_
All endpoints called by xSP on its SupportCenter page.

### createIssue

The "CreateIssue" endpoint has been designed specifically to create an issue on the support center.

For the postData, please refer to the [Offer](#Issue) table for all required fields.

The `SupportClient::createIssue()` method returns a `IssueEntity`.

### listIssues

The "listIssues" endpoint is used in order to list all issues of a given user.

The `SupportClient::listIssues()`  method returns an array of `IssueEntity`.

### getIssue

The "getIssue" endpoint permit the related user to get a specific issue.

When calling it, it is necessary to specify desired id.

The `SupportClient::getIssue()`method returns a `IssueEntity`.

### closeIssue

The "closeIssue" endpoint is used to update the issue in order to close it when it is canceled or resolved'.

When calling it, it is necessary to specify desired id.

The `SupportClient::closeIssue()` method returns a `IssueEntity`.

### listTopics

The "listTopics" endpoint has been designed for list all topics the user can report an issue.

The `SupportClient::listTopics()` method returns an array of `TopicEntity`.

## Note

For all the endpoints below, it is necessary to specify the correct related issue id.


### addAttachment

The "addAttachment" endpoint allows the related user to add an attachment to the issue.

The `SupportClient::addAttachment()` method just returns a the new added attachement id.

### listAttachments

The "listAttachments" endpoint allows the related user to list all attachments link to a specific issue.

The `SupportClient::listAttachments()` method returns an array of `AttachmentEntity`.

### getAttachment

The "getAttachment" endpoint permit the related user to get a specific attachment.

The `SupportClient::getAttachment()` method just returns the new added attachment id.

### listComments

The "listComments" endpoint is used to retrieve all comments a user has posted to the support center.

The `SupportClient::listComments()` method returns an array of `CommentEntity`.

### addComment

The "addComment" endpoint is used to add a new comment.

The `SupportClient::addComment()` method just returns the new added comment id.
