---
layout: page
title: Kaltura Web Video Player Configuration and Parameters
weight: 403
---

The Kaltura Web Video Player configuration is determined by a JSON structured configuration object, which is also called **Flashvars**. The Flashvars configuration parameters object defines key / value pairs for Player properties as well as a plugins configuration list.   

You can customize the Web Video Player using one of two options:

1. **Using Kaltura Universal Studio:** The Universal Studio is a part of the Kaltura KMC and allows visual configuration of player parameters and plugins.  
For more infomation and a full user guide, please refer to the [Universal Studio Information Guide](https://knowledge.kaltura.com/node/1148).  
The Universal Studio saves the Flashvars object for you as part of the player's configuration in the Kaltura database. When using Studio, you do not have to define the Flashvars object manually.  
2. **Define a Flashvars object as part of your embed code:** Using this method, define your Flashvars object as a JSON object in your Player embed code statement. You can define values for player properties and plugins configuration.  

>Note: The values defined in the embed code Flashvars objects override any values that were saved previously using the Studio for the same keys.   

## Considerations for Configuring Players

How should you configure the player, and what to consider when specifying configuration parameters? As a general rule of thumb, you should always prefer to configure Flashvars via the Studio menus and the "UI Variables" section for the following reasons:  

* The configuration defined in Studio applies to all player instances across web pages and embed codes, whereas embed code Flashvars applies only to a specific player instance.
* The Universal Studio's visual and self explanatory interface makes it easy to implement the most commonly used player properties and plugins.

### Scenarios for Using Embed Code Flashvars   

> Note that any changes made via Flashvars on the embedding page will require editing these pages to make future changes. 

1. You need to set the Flashvars values dynamically based on your website / application logic.
For example, you may need to pass metadata fields that are derived from the specific view or page at runtime and, therefore, you will need to set these values only when rendering the player.

2. You want to inherit all of the Player properties defined in Studio but you need to override specific properties for a specific player instance. Note that if you want to use the configuration across many pages or sites, it is better practice to create a new player and configure it via the Player Studio.    

### Passing Configuration Parameters in Embed Methods

The Kaltura Web Video Player can be embedded into webpages in a number of ways. The embed code Flashvars object is passed in a different way for different embed types. This section will help you to learn more about embed types.  

#### Configure Parameters in JavaScript Dynamic Embed

For dynamic embeds, use a JSON object as part of your embed code:  

```javascript
kWidget.embed({
    'targetId': 'kaltura_player',
    'wid': '_243342',
    'uiconf_id' : '12905712',
    'entry_id' : '0_uka1msg4',
    'flashvars': {
        'autoPlay': true,
        'watermark': {
            'plugin' : "true",
            'img' : "http://www.kaltura.com/content/uiconf/kaltura/kmc/appstudio/kdp3/exampleWatermark.png",
            'href' : "http://www.kaltura.com/",
            'cssClass' : "topRight"
        }
    }
});
```

#### Configure Parameters in iFrame Embed

For auto / iFrame embeds, pass the key / value pairs on the iFrame URL query string using the Flashvars with brackets and dot syntax for nested object attributes as follows:   

* Instead of `flashvars: { autoPlay: true }`, use the following notation: `flashvars[autoPlay]=true` 
* Instead of `flashvars: { share: { plug: true } }`, use the following notation: `flashvars[share.plugin]=true`

```html
<iframe src="http://cdnapi.kaltura.com/p/1645161/sp/164516100/embedIframeJs/uiconf_id/33752651/partner_id/1645161?iframeembed=true&playerId=kaltura_player&entry_id=1_1josgev8&flashvars[autoPlay]=true&flashvars[share.plugin]=true" width="560" height="395" allowfullscreen webkitallowfullscreen mozAllowFullScreen frameborder="0"></iframe>
```

## Common Player Configuration Scenarios

* Auto start video playback with a muted video, at a start point of 20 seconds:

```javascript
'flashvars': {
        'autoPlay': true,
        'autoMute': true,
        'mediaProxy.mediaPlayFrom': 20
    }
```

* Force a specific streamer type:

```javascript
'flashvars': {
        'streamerType': 'hdnetworkmanifest'
    }
```

* Lead with HLS playback on all devices:

```javascript
'flashvars': {
        'LeadWithHLSOnFlash': true,
        'Kaltura.LeadHLSOnAndroid': true
    }
```

* Define a plugin configuration (this example overrides the volume control horizontal layout and sets it to vertical):

```javascript
'flashvars': {
        'volumeControl':{
                'layout': 'vertical',
                'align': 'right'
            },
    }
```

* Set Flashvars dynamically according to data derived from a server:

```javascript
$.ajax({
    method: "POST",
    url: "getMetaData.php",
    data: { entry_id: "1_sf5ovm7u" }
})
.done(function( metaData ) {
    kWidget.embed({
        'targetId' : 'kaltura_player',
        'wid': '_243342',
        'uiconf_id' : '12905712',
        'entry_id' : '1_sf5ovm7u',
        'flashvars' : {
            'youbora': {
                'trackEventMonitor': 'trackYouboraAnalyticsEvent',
                'bufferUnderrunThreshold': 1000,
                'userId': 'my-user-id',
                'contentMetadata': metaData
            }
        }
    });
});
```
