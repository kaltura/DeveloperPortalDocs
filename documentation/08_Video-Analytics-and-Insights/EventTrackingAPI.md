---
layout: page
title: Kaltura Analytics - Event Tracking API
---

## Overview
The Event Tracking API is an extensible interface for tracking different types of events on the Kaltura Analytics backend, and, eventually, to aggregate them into meaningful and values reports.

The API is based on an HTTP GET request that persists the tracked event without validation (at this stage) and returns HTTP code 200 (OK) and a small payload of the Unix timestamp representing the time on the server at the moment of receiving the event (for example: 1459671407).

Each event type has required and optional parameters, which are described below.

## Examples
### cURL
{% extlink curl http://tbd.analytics.domain/api_v3/index.php?service=analytics&action=trackEvent&kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance %}

### Vanilla Javascript
{% extlink var kanalonyTrackUrl http://tbd.kaltura.com/collect?kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance %}";

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
'$.ajax({

url: "http://tbd.kaltura.com/collect?kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance",
    context: document.body,
    success: function(){
      alert("tracked!");
    }
});'

## Supported Events
| Group       | Name     | ID     | Description
|:---|:---|:---|:---|
| Basic             | Partner            |  partner | The partner account ID on Kaltura's platform	|

## Event Parameters Explanation
| Parameter       | Description
|:---|:---|
| eventType	| A number describing the event type specified for each event| 
| partnerId	| The partner account ID on Kaltura's platform| 
| entryId	| The delivered content ID on Kaltura's platform| 
| flavourId	| The ID of the flavour that is currently displayed (for future use, will not be used in aggregations) | 
| ks| 	The Kaltura encoded session data| 
| sessionId	| A unique string that identifies a unique viewing session, a page refresh should use different identifier| 
| eventIndex	| A sequence number that describes the order of events in a viewing session| 
| bufferTime	| The amount time spent on bufferring from the last viewing event (should be 0 to 10 in view events, and 0 to ∞ for play events)| 
| actualBitrate	| The bitrate of the displayed flavour in kbps| 
| preferredBitrate| 	Tthe bitrate of the preferred flavour that was set using the flash var| 
| referrer	| The url of the page showing the content| 
| deliveryType| 	The Player's streamerType (i.e. hls, http, smoothStream)| 
| playbackType	| The type of the current playback (i.e., vod, live, dvr)| 
| kalsig | The MD5 signature of all the querystring params| 
| sessionStartTime| 	The timestamp of the first event in the session (in Unix Time format)| 
| uiConfId| 	The Player ID and configuration the content was played on| 
| clientVer| 	The Player version| 
| clientTag| 	?| 
| position| 	The position of the movie in seconds (this should be 0 on event types 1,2,3)| 
| playbackContext	| The category id describing the current played context| 
| customVar1| 	An optional custom parameter that can be used to segment the data| 
| customVar2	| An optional custom parameter that can be used to segment the data| 
| customVar3	| An optional custom parameter that can be used to segment the data| 
| socialNetwrok	| The ID of the social network used for sharing| 
| reportType	| The type of inappropriate content reported | 
| targetPosition| 	The position of the movie, in seconds, to which the user requested to change| 

