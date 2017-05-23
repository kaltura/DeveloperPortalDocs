---
layout: page
title: Kaltura Audit-Trail - Viewer Example Application
weight: 106
---

The object that is created for each event is the [KalturaAuditTrail](https://developer.kaltura.com/api-docs/Secure_Control_and_Govern/auditTrail), which may be created as result of each one of the actions in [KalturaAuditTrailAction](https://developer.kaltura.com/api-docs/General_Objects/Enums/KalturaAuditTrailAction) on any of the object types in [KalturaAuditTrailObjectType](https://developer.kaltura.com/api-docs/General_Objects/Enums/KalturaAuditTrailObjectType).

## Description of Actions  

### Automatic Events  

* CHANGED - Object changed in the database
* COPIED - Object created in the database by cloning existing object
* CREATED - Object created in the database
* DELETED - Object status changed to deleted (in fact this object wasn’t deleted from the database)
* FILE_SYNC_CREATED - File saved to the disc, related to the object

Additional events that could be reported using the API (not automatically) and as such could be triggered when the customer think it’s relevant:
* CONTENT_VIEWED
* RELATION_ADDED
* RELATION_REMOVED
* VIEWED

## Usage  

The purpose of this API is to add and list events using the [Audit Trail](https://developer.kaltura.com/api-docs/#/auditTrail) service.
