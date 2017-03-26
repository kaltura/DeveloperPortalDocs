---
layout: page
title: Kaltura's Scheduling API Service
weight: 303
---

Kaltura's Scheduling service enables partner devices to schedule events for each device, and to use information from those events to ingest recorded content back to Kaltura with additional metadata. This provides the option of managing automated recording schedules for organizations such as educational institutions.

The automated recording schedule is managed through Kaltura's solution and through the recording itself (via partners). The interface used between Kaltura and the partner devices is the Kaltura API which is exposed in iCal format for scheduled events. This service provides backend support for calendar definition, including importing and exporting using the iCal standard. Importing into the Kaltura server is done either though bulk-upload or drop-folders. 

Note that currently this solution is implemented for VOD only.

## Quick Start  

To use Kaltura's Scheduling API, the administrator should follow these basic scheduling steps:

1. Configure an event for a future date.
2. Set the recording device as the resource for the event.
3. Define an entry template for the event that includes metadata on the entry resulting from the scheduled event (this should include information on how to publish the entry, co-editors, description/title, etc.).
4. Configure the device to sync the internal calendar with the Kaltura calendar periodically using a HTTP/HTTPS request or via FTP (in which case the events relating to that device will be parsed). FTP supports the same formats as the HTTP, JSON, XML and iCal.
The device will record at the pre-set time and store the recording locally.
The device will upload the recording to Kaltura, setting the relevant parameters on the entry itself, including the entry template and any additional metadata. Configuration of the device depends on manufacturer documentation and settings.
The user will be able to view the created recording in the KMC. 

The Scheduling Module in KMS or KAF can be used to view and create events. If the recording was published to a course or category, it will appear there for all users with permissions to access it. 

## Implementation  

Scheduling is implemented as a plugin that defines new object types for schedule-events and schedule-resources.

### Pull Request  

The pull request can be implemented via HTTP/HTTPS or FTP:

* **HTTP(S)**: The schedule can be pulled using the API through XML, JSON or iCal.
* **FTP**: The schedule can be pulled using an abstract FTP server that will log in using the Kaltura API user and will display events as files.

### Push Request  

The schedule can be pushed via the Kaltura API or as iCal using Kaltura drop-folders that may be accessed using FTP, SFTP or Aspera. If the drop-folder is located on the partner data-center, the Kaltura server can pull the files using FTP, SFTP and S3, iCal format may also be ingested directly using the Kaltura bulk-upload APIs.

### Ingest  

The schedule can be defined using KMS and APIs, or by using an iCal drop-folder.

## iCal Kaltura Specific Parameters  

| Name       | Description | Format |
|:------------ |:------------------:|------------------:|
|X-KALTURA-ID  | Event ID in Kaltura               |   int        |
| X-KALTURA-PARTNER-ID  | Kaltura partner ID          | int         | 
| X-KALTURA-PARENT-ID  | If a single occurrence as part of a series (recurring event), the parent ID will be the recurring event.          | int         | 
| X-KALTURA-STATUS  | Status of the event in Kaltura         | int         |
|X-KALTURA-CATEGORY-IDS  | The list of categories to which the event belongs           |  Unlimited, comma-separated integers        |
|X-KALTURA-ENTRY-IDS  | The Entry IDs related to this event               |   Unlimited, comma separated integers; each string is exactly 10 ASCII characters (0-1, a-z and underscore).     |
|X-KALTURA-RESOURCE-IDS  | The Kaltura resource ID for the resources used in the event |   Unlimited, comma-separated integers    |
|X-KALTURA-TAGS  | Metadata tags for the event |  An unlimited number of unlimited, comma-separated strings.; all tags combined, including the commas, should be less than 65k.    |
|X-KALTURA-TEMPLATE-ENTRY-ID  | Template entry to be used for entries created based on this event. The template entry will define the recording owner, categories for the recorded entry, co-editors, etc.  |   Exactly 10 ASCII characters (0-1, a-z and underscore)      |
|X-KALTURA-TYPE  | Defines the type of entry required by this event: live or VOD.               |   1 – recording; 2 – live-stream  |


## Uploading a Recording to Kaltura  

When uploading a scheduled event recording to Kaltura, certain information from the event itself should be used:

* The partner ID must be used to create a Kaltura Session (KS) for upload.  

Use one of the following options:

* **Via XML/CSV:** The templateEntryId can be set via [XML bulk](http://www.kaltura.com/api_v3/xsdDoc/index.php?type=bulkUploadXml.bulkUploadXML). The templateEntryId is also supported in CSV.
* **Via API:** The templateEntryId can be set via [API](https://developer.kaltura.com/api-docs/General_Objects/Objects/KalturaBaseEntry).

### Publishing Permissions  

To enable the device to use an entry template that includes publishing to specific categories or channels, the device must use the correct entitlements when uploading. One option is for the device to use an admin secret and to upload all recordings as an administrator. However, this option is not recommended because it requires exposing the admin secret on every device. 
The recommended option is to use an app-token, which requires partner preparation and using app token APIs to upload from the device.

#### Partner Preparation  

Perform the following preparation steps:

1. Create an app-token for the partner (appToken.add) using the following:
 * sessionType – user
 * sessionPrivileges – disableentitlement,setrole:CAPTURE_DEVICE_ROLE
2. Configure the ID and token of the created app-token on the device.

#### Device Upload APIs  

Follow these steps to use the device upload APIs:

1. Create a weak widget KS (session.startWidgetSession).
2. Create a strong KS (appToken.startSession).
3. Create an upload-token (uploadToken.add).
4. Upload the media (uploadToken.upload).
5. Create a new entry with the template-entry id (media.add).
6. Associate the entry with the uploaded media (media.addContent).

## iCal Sync from Kaltura  

iCal export is supported via HTTP/HTTPS or FTP. 

### Filtering and Pagination of Results  

All Kaltura list actions, including [scheduleEvent.list](https://developer.kaltura.com/api-docs/Integration_Scheduling_and_Hooks/Scheduling_Triggers_using_iCal/scheduleEvent/scheduleEvent_list), accept the [KalturaFilterPager](https://developer.kaltura.com/api-docs/General_Objects/Filters/KalturaFilterPager). For example:
http://www.kaltura.com/api_v3/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventFilter/filter:resourceIdsLike/33/pager:pageSize/30/pager:pageIndex/2
ftp://api.kaltura.com/format/ical/schedule_scheduleevent/filter:objectType/KalturaScheduleEventFilter/filter:resourceIdsLike/33/pager:pageSize/30/pager:pageIndex/2.
 
For a list of filters see: [KalturaScheduleEventFilter](https://developer.kaltura.com/api-docs/General_Objects/Filters/KalturaScheduleEventFilter). 
Note that more than one filter can be applied to each request. 
Time attributes support both absolute and relative times. The time is measured in seconds since 1970, also known as a UNIX timestamp; however, if you specify a time that is smaller than 1980 (in seconds since 1970), e.g., 0, 60, or -60, Kaltura will calculate the past value as a relative time, for example:
0 = now.
60 = now + 60 seconds – which is 60 seconds from now.
-60 = now - 60 seconds – which is 60 seconds ago.

For example, the request  http://www.kaltura.com/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventBaseFilter/filter:startDateGreaterThanOrEqual/0
 will return events that start now or in the future. 

### FTP  

FTP can be used to retrieve [a list of events](ftp://api.kaltura.com/format/ical/schedule_scheduleevent/filter:objectType/KalturaScheduleEventFilter/). The maxiumum number of returned results is 10,000 (500 max per page, 20 pages max). Partners can use the FTP list to identify which files have changed or are new, and then sync only the delta. 

The results can be filtered on any of the parameters. For example: 
ftp://api.kaltura.com/format/ical/schedule_scheduleevent/filter:objectType/KalturaScheduleEventFilter/filter:resourceIdsLike/RESOURCE-ID. 

To use FTP, you will need to use KMC user credentials. A user with limited permissions should be created for this purpose only. The username should be structured as [partner ID]/[user ID].

### HTTP/S  

You may download files via HTTP/S. The maximum number of returned results is 500 per page and 10,000 total. To filter the next 10,000 you will need to add a filter, for example: [createdAtGreaterThanOrEqual](https://developer.kaltura.com/api-docs/General_Objects/Filters/KalturaAccessControlBaseFilter). Partners will need to use a KS to request a list of events. 

The results can be filtered on any of the parameters. For example: 
http://www.kaltura.com/api_v3/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventFilter/filter:resourceIdsLike/RESOURCE-ID

http://www.kaltura.com/api_v3/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventBaseFilter/filter:startDateGreaterThanOrEqual/0
 
## Configuring Resources on Kaltura  

Capture devices can be mapped to resource objects in Kaltura. This is similar to booking a conference room using a calendar application. Multiple resources can be defined for an event. Resources can be added using the API (e.g. automatic creation of a matching resource by the device itself) or bulk uploaded in advance using .csv format. 
Kaltura's .csv format supports mixed orders, and not all fields are required; the fields are defined by the user using an asterisk at the beginning of the line.

For example:
*action,name,type,systemName,description,tags,parentType,parentSystemName
1,my resource name,camera,my-camera1,my example camera,"tag1,tag2",location,my-parent1

To modify the resources list use the following actions:

* 1- add(default)
* 2- update
* 3- delete
* 6- add or update

Be certain to modify the action column accordingly.

The APIs can be found under the [Integration, Scheduling and Hooks](https://developer.kaltura.com/api-docs/Integration_Scheduling_and_Hooks) section in the developer.kaltura.com site.

These are the defaults if a field is missing:

| Field       | Description / Default | 
|:------------ |:------------------:|
| action - add/update/delete  |  For the update and delete actions, resourceId can be used instead of systemName. |  
| name  |  Required with no default. |  
| type  |  Location/camera |  
| systemName  |  Null |  
| description  |  Null |  
| tags  |  Null |  
| parentType  |  Location |  
| parentSystemName  |  Null |  

Note that resources can have a hierarchy (e.g., a room with cameras), which is defined using the parent type and name. For an example of the API call to create a resource, in this case of type camera, click here.

## Other Considerations  

* Conflicting events: At present, Kaltura does not prevent conflicting events. The user will need to ensure that there is no resource conflict when scheduling the event. Devices should be able to handle resource conflicts and ensure operations in this case. 
* Recurring events: When using HTTP/S or FTP, both the series and the breakdown of each occurrence will be provided. Devices can filter based on [event type](https://developer.kaltura.com/api-docs/General_Objects/Objects/KalturaScheduleEventRecurrence) to receive only the series and single events, or to receive single events and breakdown of series. The choice between the options depends on the capability of the device. 
