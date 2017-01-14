---
layout: page
title: Configuring the Kaltura Stats Plugin on Android Devices
subcat: SDK 3.0 (Beta) - iOS
weight: 296
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required for configuring the Kaltura Video Player to use the Kaltura Stats Plugin on iOS devices. This will enable you to obtain important statistical information about usage.

## Enabling the Youbora Plugin for the Kaltura Video Player  

To enable the TVPAPI Stats Plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```
pod 'PlayKit/KalturaStatsPlugin'
```

## Register the Kaltura Stats Plugin for the Kaltura Video Player  

To enable the Kaltura Stats Plugin, register the plugin inside your application as follows:

```
PlayKitManager.sharedInstance.registerPlugin(KalturaStatsPlugin.self)
```

## Configure the Analytics Configuration Object for the Kaltura Stats Plugin  

To configure the Kaltura Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```
let analyticsConfig = AnalyticsConfig()
var params: [String : Any]
params["sessionId"] = "sessionId"
params["baseUrl"] = "baseUrl" 
params["uiconfId"] = "baseUrl" 
params["partnerId"] = "baseUrl" 

params["timeInterval"] = 30000 //Timer interval to check progress of the media in milliseconds- recommended value - short media - 10000, long media - 30000

analyticsConfig.params = params
```

### Set the Plugin Configuration to the Kaltura Stats Plugin  

To ensure that the Kaltura Stats Plugin starts loading, you'll need to set the plugin configuration you created as follows:

```
var playerController: Player!
let config = PlayerConfig()
var pluginsConfig = [String : AnyObject?]()
playerConfig.plugins[KalturaStatsPlugin.pluginName] = analyticsConfig
self.playerController = PlayKitManager.sharedInstance.loadPlayer(config: playerConfig.plugins)
```

## Kaltura Stats Plugin Supported Events  

The Kaltura Stats Plugin supports the following events:

```
enum KStatsEventType : Int {
case WIDGET_LOADED = 1
case MEDIA_LOADED = 2
case PLAY = 3
case PLAY_REACHED_25 = 4
case PLAY_REACHED_50 = 5
case PLAY_REACHED_75 = 6
case PLAY_REACHED_100 = 7
case OPEN_EDIT = 8
case OPEN_VIRAL = 9
case OPEN_DOWNLOAD = 10
case OPEN_REPORT = 11
case BUFFER_START = 12
case BUFFER_END = 13
case OPEN_FULL_SCREEN = 14
case CLOSE_FULL_SCREEN = 15
case REPLAY = 16
case SEEK = 17
case OPEN_UPLOAD = 18
case SAVE_PUBLISH = 19
case CLOSE_EDITOR = 20
case PRE_BUMPER_PLAYED = 21
case POST_BUMPER_PLAYED = 22
case BUMPER_CLICKED = 23
case PREROLL_STARTED = 24
case MIDROLL_STARTED = 25
case POSTROLL_STARTED = 26
case OVERLAY_STARTED = 27
case PREROLL_CLICKED = 28
case MIDROLL_CLICKED = 29
case POSTROLL_CLICKED = 30
case OVERLAY_CLICKED = 31
case PREROLL_25 = 32
case PREROLL_50 = 33
case PREROLL_75 = 34
case MIDROLL_25 = 35
case MIDROLL_50 = 36
case MIDROLL_75 = 37
case POSTROLL_25 = 38
case POSTROLL_50 = 39
case POSTROLL_75 = 40
case ERROR = 99
}

```




