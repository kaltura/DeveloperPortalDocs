---
layout: page
title: Adding a Thumbnail Flavor Paramter that Supports Resizing Auto-generated Thumbnails
---

This short guide describes how to create thumbnail flavor and add it to the Kaltura account transcoding profile through API. This method also support auto-generation and resizing of thumbnail dimensions when a new entry is uploaded to the account. This is a useful method to automatically create specific thumbnails upon entry ingestion.

1.  Using the thumbParams service and add action.
2.  Select KalturaThumbParams under thumbParams and click the Edit button next to it.
1.  Set the thumbParams:cropType to RESIZE\_WITH\_FORCE in order to force the exact thumbnail dimensions regardless of the original media entry dimensions/aspect ratio.
2.  Set the thumbnail width and height in thumbParams:width and thumbParams:height.  
    <img src="../../assets/506.img">

3.  Copy into a temporary editor (e.g. notepad) the returned flavor param id (will show in the result box in the form of: *<id>XXX</id>*). 
4.  Visit the <a href="http://www.kaltura.com/index.php/kmc/kmc4#account|transcoding" target="_blank">Transcoding Settings panel in the KMC</a>, switch to Advanced Mode and copy the id of the Transcoding Profile you wish to add the new thumbnail profile to.
5.  Call the conversionProfile service and get action providing the desired conversion profile id from the KMC.
1.  Copy the result element of flavorParamsIds to a temporary text editor.  
    For example, the result of conversionProfile.get action will look like the following: *<flavorParamsIds>5,4,3,2,1,0,6</flavorParamsIds>*  
    Copy the value:  *5,4,3,2,1,0,6*

6.  Append the flavor param id that from step 3 to the end of flavorParamsIds from the previous step.  
    For example: 5,4,3,2,1,0,6,XXX 
7.  Call the conversionProfile service and update action with the new conversion profile id as the value of conversionProfile:flavorParamsIds.  
    <img src="../../assets/505.img">
8.  The transcoding profile is now updated with the new thumbnail flavor. 

<div>
  <p>
     
  </p>
  
  <p>
    From now on whenever a new entry is ingested a new thumbnail will be generated with the desired dimensions and added automatically to the entry.
  </p>
  
  <p>
     
  </p>
</div>

<p class="mce-note-graphic">
  <span>Note that the new thumbnail flavor doesn’t appear in the KMC account transcoding in Kaltura versions prior to Falcon.</span>
</p>

 

 

 

 
