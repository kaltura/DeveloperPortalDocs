---
layout: page
title: Kaltura Video Insights - Event Tracking API
weight: 140
---

*This API is a part of Kaltura's new analytics platform.*
*It is available by request, as it is currently released as an Early Preview.*
*Please write to maya.schnaidman@kaltura.com to request activation.*

The Event Tracking API is an extensible interface for tracking different types of events on the Kaltura Video Insights backend, and, eventually, to aggregate them into meaningful and values reports.

The API is based on an HTTP GET request that persists the tracked event without validation (at this stage) and returns HTTP code 200 (OK) and a small payload of the Unix timestamp representing the time on the server at the moment of receiving the event (for example: 1459671407).

Each event type has required and optional parameters, which are described below.

## Examples
### cURL
``` curl http://tbd.analytics.domain/api_v3/index.php?service=analytics&action=trackEvent&kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance.``` 

### Vanilla Javascript
``` var kanalonyTrackUrl http://tbd.kaltura.com/collect?kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance;``` 

    var xmlhttp;

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
           if(xmlhttp.status == 200){
               alert(xmlhttp.responseText);
           }
           else if(xmlhttp.status == 400) {
              alert('There was an error 400')
           }
           else {
               alert('something else other than 200 was returned')
           }
        }
    }

    xmlhttp.open("GET", kanalonyTrackUrl, true);
    xmlhttp.send();'
    
### JQuery
    $.ajax({
    url: "http://tbd.kaltura.com/collect?kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance",
    context: document.body,
    success: function(){
      alert("tracked!");
    }
});

## Supported Events  
The Event Tracking API supports the following events:

| Event       | Event Type      | Beacon sent...     | Required Parameters | Optional Parameters 
|:---|:---|:---|:---|:---
| Player Impression|	1|	When player code is initialized (widget is loaded)|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Play Requested|	2	|When play button is clicked|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Play|	3|	When non-ad media starts to play|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex, bufferTime, actualBitrate, preferredBitrate|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Resume|	4|	When playback is resumed	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex, bufferTime, actualBitrate, preferredBitrate|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Play reached 25%|	11|	When view reached 25% of the content length	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Play reached 50%	|12	|When view reached 50% of the content length|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Play reached 75%|	13|	When view reached 75% of the content length	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Play reached 100%	|14	|When view reached 100% of the content length|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Share Clicked	|21	|When share button was clicked|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Shared|	22	|When social network share modal activated	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex, socialNetwork	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3|
| Download clicked|	23|	When Download button was clicked|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Report clicked	|24	|When report button was clicked	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Report submitted	|25	|When report was actually submitted	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex, reportType	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Enter fullscreen|	31	|When user toggled fullscreen on|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Exit |fullscreen|	32	|When user toggled fullscreen off|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Pause clicked	|33	|When pause button was clicked	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| Replay clicked|	34	|When replay button was clicked	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3|
| Seek|35|	When playback position change requested	|eventType, partnerId, entryId, flavourId, sessionId, eventIndex, targetPosition|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
|relatedClicked| 36	|When related button was clicked|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
|relatedSelected|37	|When related content was selected|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
|captions| 38	|User selected a caption|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex, caption|	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
|sourceSelected|39	|User initiated flavour change|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
|info |40|	User clicked on info icon|	eventType, partnerId, entryId, flavourId, sessionId, eventIndex	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
|speed |41|	User changed playback speed	eventType, partnerId, entryId, flavourId, sessionId, eventIndex, playbackSpeed |	ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3
| View | 99	| When content is played, every 10 seconds | 	eventType, partnerId, entryId, flavourId, sessionId, eventIndex, bufferTime, actualBitrate, preferredBitrate	|ks, playbackContext, referrer, deliveryType, playbackType, kalsig, sessionStartTime, uiConfId, clientVer, clientTag, position, customVar1, customVar2, customVar3


## Event Parameters Explanation  

| Parameter       | Description
|:---|:---
| eventType	| A number describing the event type specified for each event
| partnerId	| The partner account ID on Kaltura's platform 
| entryId	| The delivered content ID on Kaltura's platform 
| flavourId	| The ID of the flavour that is currently displayed (for future use, will not be used in aggregations)  
| ks| 	The Kaltura encoded session data 
| sessionId	| A unique string that identifies a unique viewing session, a page refresh should use different identifier  
| eventIndex	| A sequence number that describes the order of events in a viewing session  
| bufferTime	| The amount time spent on bufferring from the last viewing event (should be 0 to 10 in view events, and 0 to ∞ for play events)  
| actualBitrate	| The bitrate of the displayed flavour in kbps  
| preferredBitrate| 	Tthe bitrate of the preferred flavour that was set using the flash var  
| referrer	| The url of the page showing the content  
| deliveryType| 	The Player's streamerType (i.e., hls, http, smoothStream) 
| playbackType	| The type of the current playback (i.e., vod, live, dvr) 
| kalsig | The MD5 signature of all the querystring params 
| sessionStartTime| 	The timestamp of the first event in the session (in Unix Time format) 
| uiConfId| 	The Player ID and configuration the content was played on 
| clientVer| 	The Player version 
| clientTag| 	?
| position| 	The position of the movie in seconds (this should be 0 on event types 1,2,3)
| playbackContext	| The category id describing the current played context 
| customVar1| 	An optional custom parameter that can be used to segment the data 
| customVar2	| An optional custom parameter that can be used to segment the data 
| customVar3	| An optional custom parameter that can be used to segment the data 
| socialNetwrok	| The ID of the social network used for sharing 
| reportType	| The type of inappropriate content reported  
| targetPosition| 	The position of the movie, in seconds, to which the user requested to change 

