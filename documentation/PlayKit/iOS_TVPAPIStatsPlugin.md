---
layout: page
title: Configuring the TVPAPI Stats Plugin on iOS Devices
subcat: SDK 3.0 (Beta) - iOS
weight: 298
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 


This article describes the steps required for using the TVPAPI Stats Plugin on iOS devices to get statistical information on the device, as well as the events supported by the plugin. 

## Enabling the Youbora Plugin for the Kaltura Video Player  

To enable the TVPAPI Stats Plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```
pod 'PlayKit/PhoenixPlugin'
```

### Register the TVPAPI Stats Plugin  

Register the TVPAPI Stats Plugin in your application as follows:

```
PlayKitManager.sharedInstance.registerPlugin(TVPAPIAnalyticsPlugin.self)
```

## Configure the Kaltura Video Player to use the TVPAPI Stats Plugin  

To configure the player to use TVPAPI Stats Plugin, add the following configuration to your `PlayerConfig` file as follows:

```
let analyticsConfig = AnalyticsConfig()
var params: [String : Any]
params["fileId"] = "fileId"
params["baseUrl" = "baseUrl" //Sample url - http://tvpapi-preprod.ott.kaltura.com/v3_9/gateways/jsonpostgw.aspx?
params["timeInterval"] = 30000 //Default value - 30000. Value is in miliseconds.
params["initObj"] = initObj //must be a valid initObj of TVPAPI
analyticsConfig.params = params

```

### Set the Plugin Configuration to the TVPAPI Stats Plugin  

To ensure that the TVPAPI Stats Plugin starts loading, you'll need to set the plugin configuration you created as follows:

```
var playerController: Player!
let config = PlayerConfig()
var pluginsConfig = [String : AnyObject?]()
playerConfig.plugins[TVPAPIAnalyticsPlugin.pluginName] = analyticsConfig
self.playerController = PlayKitManager.sharedInstance.loadPlayer(config: playerConfig.plugins)

```

## TVPAPI Stats Plugin Supported Events  

The TVPAPI Stats Plugin supports the following events:

```
 TVPAPI action Types{
 MediaHit, //outputs every interval time
 MediaMark //Outputs in the following events - {PLAY,STOP,PAUSE,FIRST_PLAY,LOAD,FINISH,BITRATE_CHANGE,ERROR}
}
```

## Concurrency Handler  

To receive concurrency events from the TVPAPI Stats Plugin, you'll need to add a listener to the following event:

``````
var playerController: Player!
self.playerController.addObserver(self, events: [OttEvent.OttEventConcurrency.self], block: {(info) in

})                    
```
