---
layout: page
title: Event Tracking API
---

## Overview
The Event Tracking API is an extensible interface for tracking different types of events on the Kaltura Analytics backend, and, eventually, to aggregate them into meaningful and values reports.

The API is based on an HTTP GET request that persists the tracked event without validation (at this stage) and returns HTTP code 200 (OK) and a small payload of the Unix timestamp representing the time on the server at the moment of receiving the event (for example: 1459671407).

Each event type has required and optional parameters, which are described below.

## Examples
### cURL
'curl "http://tbd.analytics.domain/api_v3/index.php?service=analytics&action=trackEvent&kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance"'

### Vanilla Javascript
'var kanalonyTrackUrl = "http://tbd.kaltura.com/collect?kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance";

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


## Event Parameters Explanation


### cURL
curl "http://tbd.analytics.domain/api_v3/index.php?service=analytics&action=trackEvent&kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance"

### Vanilla Javascript
    var kanalonyTrackUrl = "http://tbd.kaltura.com/collect?kalsig=1ebb5aea0c5f253fd8c578febe6a752f&clientTag=kdp%3Av3%2E9%2E2&sessionId=C90BFCFC%2D2EBF%2D5893%2D892D%2D2121162F414A&eventIndex=3&eventType=2&referrer=http%253A%2F%2Fabc%2Ego%2Ecom%2Fshows%2Fthe%2Dbachelorette%2Fvideo%2Fmost%2Drecent%2FVDKA0%5Flawz79v7&entryId=0_n5nbuy6i&ks=YjdlZTNkMGUzZDYxMzY0OGJjZDVjOTYzOWVkMjFlNTg2ZmMyZDRlOXw1ODUyMzE7NTg1MjMxOzE0MzUxNjA2NzY7MDsxNDM1MDc0Mjc2Ljc2MTk7MDt2aWV3Oiosd2lkZ2V0OjE7Ow%3D%3D&sessionStartTime=1435075182567&uiConfId=23521211&partnerId=585231&position=18&clientVer=3%2E0%3Av3%2E9%2E2&playbackContext=sports&customVar1=Finnance";

    var xmlhttp;

