temp
---
layout: page
title: Kaltura Scheduling API for Partners
---


Scheduling via Kaltura enables partner devices to use an iCal file managed by Kaltura for scheduling events for each device, and to use information from those events to ingest recorded content back to Kaltura with additional metadata. 

A basic scheduling flow includes the following: 

1. The administrator configures an event via Kaltura for a future date. The admin sets the recording device as the resource and provides an entry template that includes metadata on the entry resulting from the scheduled recording. The entry template will include information on how to publish the entry, co-editors, description/title, etc. 
2. The device is configured to sync the internal calendar with the Kaltura calendar periodically. The device will pick up the relevant events via HTTP request or FTP and will parse the events for those relating to that device. 
3. The device will record at the pre-set time and store the recording locally. 
4. The device will upload the recording to Kaltura, setting the relevant parameters on the entry itself, including the entry template and any additional metadata. 
5. The user will be able to view the recording in their course as part of the Kaltura building block or in KMS. 


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

When uploading a recording to Kaltura that's a result of a scheduled event, certain information from the event itself should be used. 
The partner ID must be used to create a KS for upload. In addition, the event includes the X-KALTURA-TEMPLATE-ENTRY-ID parameter that must be set during entry creation (see iCal parameters above).

### Via XML/CSV  

The templateEntryId can be set via XML bulk upload using the following:
http://www.kaltura.com/api_v3/xsdDoc/index.php?type=bulkUploadXml.bulkUploadXML

### Via API  

The templateEntryId can be set via the API as follows:

http://www.kaltura.com/api_v3/testmeDoc/?object=KalturaBaseEntry

## Publishing Permissions  

To enable the device to use an entry template that includes publishing to specific categories or channels, the device must use the correct entitlements when uploading. One option is for the device to use an admin secret and to upload all recordings as an administrator. However, this option is not recommended because it requires exposing the admin secret on every device. 
The recommended option is to use an app-token, which requires partner preparation and using app token APIs to upload from the device.

### Partner Preparation  

1. Create an app-token for the partner (appToken.add):
sessionType – user
sessionPrivileges – disableentitlement,setrole:CAPTURE_DEVICE_ROLE
2. Configure the ID and token of the created app-token on the device

#### Device Upload APIs  
Follow these steps to use the device upload APIs:
1. Create a weak widget KS (session.startWidgetSession)
2. Create a strong KS (appToken.startSession)
3. Create an upload-token (uploadToken.add)
4. Upload the media (uploadToken.upload)
5. Create a new entry with the template-entry id (media.add)
6. Associate the entry with the uploaded media (media.addContent)

## iCal Sync from Kaltura  

iCal export is supported via HTTPS or FTP. 
### FTP  

Can be used to retrieve a list of events: 
ftp://api.kaltura.com/format/ical/schedule_scheduleevent/filter:objectType/KalturaScheduleEventFilter/
The maxiumum number of returned results is 10,000 (500 max per page, 20 pages max). Partners can use the FTP list to identify which files have changed or are new, and then sync only the delta. 

The results can be filtered on any of the parameters. For example: 
ftp://api.kaltura.com/format/ical/schedule_scheduleevent/filter:objectType/KalturaScheduleEventFilter/filter:resourceIdsLike/RESOURCE-ID 

To use FTP, the credentials must be a KMC user. A user with limited permissions should be created for this purpose only. The username should be structured as <partner ID>/<user ID>.

### HTTP/S  

Download of the files can be done via HTTP/S: 
http://www.kaltura.com/api_v3/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventFilter/
The maximum number of returned results is X. Partners will need to use a KS in order to request a list of events.  
The results can be filtered on any of the parameters. For example: 
http://www.kaltura.com/api_v3/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventFilter/filter:resourceIdsLike/RESOURCE-ID
http://www.kaltura.com/api_v3/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventBaseFilter/filter:startDateGreaterThanOrEqual/0

### Filtering and Pagination of Results  

All Kaltura list actions, including scheduleEvent.list, accept the KalturaFilterPager. For example:
http://www.kaltura.com/api_v3/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventFilter/filter:resourceIdsLike/33/pager:pageSize/30/pager:pageIndex/2
ftp://api.kaltura.com/format/ical/schedule_scheduleevent/filter:objectType/KalturaScheduleEventFilter/filter:resourceIdsLike/33/pager:pageSize/30/pager:pageIndex/2
 
For a list of filters see: http://www.kaltura.com/api_v3/testmeDoc/index.php?object=KalturaScheduleEventFilter. 
Note that more than one filter can be applied to each request. 

In the Kaltura API, time attributes support both absolute and relative times. The time is measured in seconds since 1970, also known as unix timestamp; however, if you specify a time that is smaller than 1980 (in seconds since 1970), e.g. 0, 60, or -60, we will calculate the past value as a relative time, for example:
0 = now.
60 = now + 60 seconds – which is 60 seconds from now.
-60 = now - 60 seconds – which is 60 seconds ago.

For example, the request
 http://www.kaltura.com/service/schedule_scheduleevent/action/list/format/ical/filter:objectType/KalturaScheduleEventBaseFilter/filter:startDateGreaterThanOrEqual/0
 will return events that start now or in the future. 
 
## Configuring Resources on Kaltura  

Our CSV format supports mixed order, and not all fields are required, the fields are defined by the user using asterisk at the beginning of the line.
For example:
*action,name,type,systemName,description,tags,parentType,parentSystemName
1,my resource name,camera,my-camera1,my example camera,"tag1,tag2",location,my-parent1
These are the defaults if a field is missing:
action - add/update/delete. For update and delete actions, resourceId could be used instead of systemName.
name - required with no default
type - location/camera
systemName - null
description - null
tags - null
parentType - location
parentSystemName - null
Resources can have a hierarchy (e.g. room with cameras), parent type and name are used to define this hierarchy. 
Here is an example of the API call to create resources (type camera):
http://www.kaltura.com/api_v3/service/schedule_scheduleresource/action/add?scheduleResource:objectType=KalturaCameraScheduleResource&scheduleResource:name=Camera 5&scheduleResource:streamUrl=rtmp://xxx&ks=djJ8MTc5NDk2MXy6mzPyYqfHU8nF5UqEiFF-2iLuI_OSVFO0Ad-KqArJ-w70X9ZLVRpO8FvF4K_l5f7Gga1S9fTcXuxM_fETaXtWAj_-63w1rfyNVrrDuNx7xog3aoe3TpbtkKeO2NhSP5sR8xaWdhA4qV84IQjUicDj 

## Other Considerations  

* Conflicting events: Currently Kaltura does not prevent conflicting events. The user will need to ensure there's no resource conflict when scheduling the event. Devices should be able to handle resource conflicts and ensure operation in this case. 
* Recurring events: When using HTTP/S or FTP, both the series and the breakdown of each occurrence will be provided. Devices can filter based on event type (e.g. http://www.kaltura.com/api_v3/testmeDoc/index.php?object=KalturaScheduleEventRecurrenceType) to receive only the series and single events, or receive single events and breakdown of series. The choice between the options depends on the capability of the device. 
