# Campaigns Client


## General information
A campaign is the entity which is used to make communications.


## Entities

### Campaign and its sub-entities

#### Campaign
A campaign is managed by the ```Campaign``` entity.

| Field       | Type                       | Example                                    | Description                                                                                 |
|-------------|----------------------------|--------------------------------------------|---------------------------------------------------------------------------------------------|
| banners     | ```Banner[]```             | an array of [Banner](#Banner)              | The campaign's banners (max 3).                                                             |
| category    | ```string```               | BANNER                                     | The type of campaign. It could be BANNER or NOTIFICATION (the later is not supported yet).  |
| createdAt   | ```string```               | 2021-06-25T16:00:00:00Z                    | The creation date of the campaign.                                                          |
| deletedAt   | ```string``` or ```null``` | 2021-08-26T18:00:00:00Z                    | The campaign are soft deleted, so this value indicates when it has been deleted.            |
| endDate     | ```string``` or ```null``` | 2021-08-01                                 | The ending date of the campaign.                                                            |
| landingPage | ```LandingPage```          | an instance of [LandingPage](#LandingPage) | The campaign's landing page.                                                                |
| name        | ```string```               | My Campaign                                | The name of the campaign. The only value needed from the client when creating a campaign.   |
| reference   | ```string```               | c925ec6e-e029-4146-8400-2867c7761743       | This is the reference of the campaign. This string is unique.                               |
| rules       | ```Rules```                | an instance of [Rules](#Rules)             | The campaign's various rules, like end customers or locations.                              |
| startDate   | ```string``` or ```null``` | 2021-08-01                                 | The starting date of the campaign.                                                          |
| updatedAt   | ```string``` or ```null``` | 2021-06-26T18:00:00:00Z                    | The date of the last time the campaign has been updated.                                    |
| weight      | ```int```                  | 1                                          | The weight indicate the importance of the campaign.                                         |

#### Banner

This entity represents the banners of the campaign.

| Field               | Type                       | Example                              | Description                                                            |
|---------------------|----------------------------|--------------------------------------|------------------------------------------------------------------------|
| backgroundImageUuid | ```string```               | d8553daa-1d39-489e-89c0-3731c0d3ad0b | The uuid to use if the banner has a background image.                  |
| buttonPlacement     | ```string```               | RIGHT                                | If the banner has a button, this defines its placement. Default: RIGHT.|
| buttonText          | ```string``` or ```null``` | Click here                           | If the banner has a button, this is its text.                          |
| text                | ```string``` or ```null``` | Banner Title                         | The banner's title. Optional only if the banner is of PICTURE type.    |
| textColor           | ```string``` or ```null``` | #119E0F                              | The banner's text color. Used for the button text and border too.      |
| type                | ```string```               | PICTURE                              | The type of banner: PICTURE or BACKGROUND_COLOR0                       |

#### LandingPage and its sub-entities

This entity and its sub-entities describe the campaign's landing page.

| Field  | Type                       | Example                                                 | Description                                                            |
|--------|----------------------------|---------------------------------------------------------|------------------------------------------------------------------------|
| body   | ```LandingPageBody```      | an instance of [LandingPageBody](#LandingPageBody)     | The body of the landing page, with description, image or video.        |
| footer | ```LandingPageFooter```    | an instance of [LandingPageFooter](#LandingPageFooter) | The footer of the landing page, with its features.                     |
| header | ```LandingPageHeader```    | an instance of [LandingPageHeader](#LandingPageHeader) | The header of the landing page, with title, baseline and logo vender.  |
| url    | ```string``` or ```null``` | http://mylandingpage.com                                | The url of the landing page. Null if the landing page is self-created. |

##### LandingPageHeader

This entity describes the header of the campaign's landing page.

| Field               | Type                       | Example                              | Description                                           |
|---------------------|----------------------------|--------------------------------------|-------------------------------------------------------|
| backgroundColor     | ```string``` or ```null``` | #001E96                              | The landing page's header background color.           |
| backgroundImageUuid | ```string```               | 0fed6621-fe0c-4290-813a-58217e37b3ae | The uuid to use if the header has a background image. |
| baseline            | ```string```               | This page will explain...            | The landing page's baseline.                          |
| textColor           | ```string``` or ```null``` | #FFFFFF                              | The landing page's text color.                        |
| title               | ```string```               | My big campaign                      | The landing page's title.                             |
| vendorLogoUuid      | ```string```               | e174e2a2-7545-4ef1-8f0c-122d0140cdea | The uuid to use to upload the vendor logo.            |

##### LandingPageBody

This entity describes the body of the campaign's landing page.

| Field               | Type                       | Example                                     | Description                                            |
|---------------------|----------------------------|---------------------------------------------|--------------------------------------------------------|
| backgroundImageUuid | ```string```               | 0fed6621-fe0c-4290-813a-58217e37b3ae        | The uuid to use if the header has an image.            |
| description         | ```string```               | <p>This is a great description.</p>         | The landing page's body description. Can contain html. |
| title               | ```string```               | This is a body title.                       | The landing page's body title.                         |
| type                | ```string```               | PICTURE                                     | The landing page's body type, PICTURE or VIDEO.        |
| videoUrl            | ```string``` or ```null``` | https://www.youtube.com/watch?v=dQw4w9WgXcQ | The landing page's body video url, if any.             |

##### LandingPageFooter

This entity describes the footer of the campaign's landing page.

| Field           | Type                       | Example                                                | Description                                            |
|-----------------|----------------------------|--------------------------------------------------------|--------------------------------------------------------|
| backgroundColor | ```string```               | #EE2436                                                | The landing page's footer background color.            |
| buttonText      | ```string```               | Click here!                                            | The text of the footer's button, after the features.   |
| buttonUrl       | ```string```               | http://mywebsite.com                                   | The url of the footer's button.                        |
| features        | ```LandingPageFeature[]``` | an array of [LandingPageFeature](#LandingPageFeature) | The landing page's features.                           |
| textColor       | ```string```               | #FFFFFF                                                | The landing page's footer text color.                  |
| title           | ```string```               | My campaign's features                                 | The landing page's footer title.                       |

##### LandingPageFeature

This entity describes the feature in the footer of the campaign's landing page.

| Field           | Type         | Example                  | Description                                                                              |
|-----------------|--------------|--------------------------|------------------------------------------------------------------------------------------|
| description     | ```string``` | This is a great feature. | The feature's description.                                                               |
| icon            | ```string``` | fa-icon                  | The feature's icon from Font Awesome.                                                    |
| title           | ```string``` | Feature #1               | The feature's title.                                                                     |
| size            | ```int```    | 4                        | The feature's size on Bootstrap grid. Set to 4 by default, unchangeable by user for now. |


#### Rules

This entity represents the rules of the campaign.

| Field         | Type           | Example                  | Description                                                     |
|-------------- |----------------|------------------------- |-----------------------------------------------------------------|
| endCustomers  | ```string[]``` | ['XSP7894', 'XSP79541']  | The different customers that will see the campaign.             |
| locations     | ```string[]``` | ['SDK']                  | The different locations of the campaign, where it can be shown. |
| marketplaces  | ```string[]``` | ['FR', 'US', 'UK']       | The different marketplaces of the campaign.                     |
| resellers     | ```string[]``` | ['XSP12345', 'XSP45678'] | The different resellers associated to the campaign.             |
| subscriptions | ```string[]``` | ['MSCSP']                | The different subscriptions related to the campaign.            |



## Usage
The campaigns client is simply called ```CampaignsClient```.
You can get it through the main entry point ```PublicApiClient``` and its method ```getCampaignsClient()```, or instanciate it directly.

### GetCampaigns

The "GetCampaigns" endpoint has been designed specifically to retrieve quickly all the campaigns.
This is the endpoint called by xSP on the Cloud Portal Campaigns page.

The ```CampaignsClient::getCampaigns()``` method returns a ```string``` that is the json containing the results.

### GetCampaign, GetActiveCampaign, GetCampaignAssets & GetCampaignAssetsUploadUrl

The "GetCampaign" endpoint is used to retrieve one specific campaign, and GetActiveCampaign will return one random active campaign for the user. "GetCampaignAssets" retrieves the assets of the campaigns, linked with the main object using UUID. The "GetCampaignAssetsUploadUrl" retrieves the url needed to upload any assets for the campaign. These too are linked with an UUID.
These endpoints are called by xSP on the Cloud Portal Campaign "View" or "Edit" pages.

This three endpoints are using the campaign's ```reference``` as parameters. The ```CampaignsClient::getCampaign()``` method returns a ```Campaign``` object, while ```CampaignsClient::getCampaignsAssets()``` and ```CampaignsClient::getCampaignAssetsUploadUrl()``` return a json ```string```.

### CreateCampaign

The "CreateCampaign" endpoint is used to create a campaign by using its ```name``` and ```category```. These are the only parameters requiered for the creation. 

The ```CampaignsClient::createCampaign()``` method returns a ```string``` that is the json defining the campaign.

### SaveCampaign

The "SaveCampaign" endpoint is used to save a campaign, using the json string of the campaign and its ```reference``` as parameters.

The ```CampaignsClient::saveCampaign()``` method returns a ```string``` that is the json defining the campaign.

### DuplicateCampaign

The "DuplicateCampaign" endpoint is used to duplicate a campaign, using the ```reference``` as parameters. It will create a new campaign with the same data (and assets), and name the new one by adding ```_COPY``` at the end of its name.

The ```CampaignsClient::duplicateCampaign()``` method returns a ```string``` that is the json defining the new campaign.

### DeleteCampaign & DeleteAssets

The "DeleteCampaign" endpoint is used to delete a campaign, using the ```reference``` as parameters. 
The "DeleteAsset" endpoint is used to delete a specific asset of a campaign, using the ```reference``` of the campaign and the ```uuid``` of the asset as parameters. 

The ```CampaignsClient::deleteCampaign()``` and ```CampaignsClient::deleteAsset()``` methods both return a string without content.
