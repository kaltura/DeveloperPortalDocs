---
layout: page
title: Adding a Thumbnail Flavor Parameter that Supports Resizing Auto-generated Thumbnails
weight: 501
---

This guide describes how to create a thumbnail flavor and add it to the Kaltura account transcoding profile through API. This method also support auto-generation and resizing of thumbnail dimensions when a new entry is uploaded to the account. This is a useful method to automatically create specific thumbnails upon entry ingestion.

## Using the thumbParams service and Add Action  

1.  Select KalturaThumbParams under thumbParams and click the Edit button next to it.
2.  Set the thumbParams:cropType to RESIZE\_WITH\_FORCE in order to force the exact thumbnail dimensions regardless of the original media entry dimensions/aspect ratio.
    a.  Set the thumbnail width and height in thumbParams:width and thumbParams:height.  
    b.  Copy into a temporary editor (e.g., Notepad) the returned flavor param ID (it will show in the result box in the form of: *<id>XXX</id>*). 
3.  Go to the [Transcoding Settings panel in the KMC](http://www.kaltura.com/index.php/kmc/kmc4#account|transcoding), switch to Advanced Mode and copy the ID of the Transcoding Profile to which you wish to add the new thumbnail profile.
4.  Call the conversionProfile service and get action providing the desired conversion profile ID from the KMC.
5.  Copy the result element of flavorParamsIds to a temporary text editor. 
For example, the result of conversionProfile.get action will look like the following: *<flavorParamsIds>5,4,3,2,1,0,6</flavorParamsIds>*  Copy the value:  *5,4,3,2,1,0,6*

6.  Append the flavor param ID that from step 3 to the end of the flavorParamsIds from the previous step.  
    For example: 5,4,3,2,1,0,6,XXX 
7.  Call the conversionProfile service and update the action with the new conversion profile ID as the value of the conversionProfile:flavorParamsIds.  
8.  The transcoding profile is now updated with the new thumbnail flavor. 

From herein, whenever a new entry is ingested, a new thumbnail will be generated with the desired dimensions and added automatically to the entry.
 
>Note: The new thumbnail flavor doesn’t appear in the KMC account transcoding in Kaltura versions prior to Falcon.

