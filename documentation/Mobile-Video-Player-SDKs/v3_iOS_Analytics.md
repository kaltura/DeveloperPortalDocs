---
layout: page
title: Analytics
subcat: SDK 3.0 - iOS
weight: 500
---

Kaltura’s Mobile Video Player SDKs for iOS make it easy for you to integrate analytics data collection, by providing you with several analytics solutions.

## Supported Analytics  

| Analytics Plugin Name | More Information |
|-----------------------|------------------|
| Kaltura Analytics     | []()             |
| Kaltura Stats         | []()             |
| TVPAPI                | []()             |
| Phoenix               | []()             |
| Youbora               | []()             |



## Kaltura Analytics Plugin  

This section describes the steps required for using the Kaltura Analytics Plugin on iOS devices as well as the events supported by the plugin. Adding the Kaltura Analytics Plugin will enable you get detailed analytics. 

<details><summary>Click for Integration</summary><p>
TBD
</p></details>

## Kaltura Stats Plugin  

This section describes the steps required for configuring the Kaltura Video Player to use the Kaltura Stats Plugin on iOS devices. This will enable you to obtain important statistical information about usage.

### Register the Kaltura Stats Plugin for the Kaltura Video Player  

To enable the Kaltura Stats Plugin, register the plugin inside your application as follows:

```swift
PlayKitManager.sharedInstance.registerPlugin(KalturaStatsPlugin.self)
```

### Configure the Analytics Configuration Object for the Kaltura Stats Plugin  

To configure the Kaltura Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```swift
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

```swift
var playerController: Player!
let config = PlayerConfig()
var pluginsConfig = [String : AnyObject?]()
playerConfig.plugins[KalturaStatsPlugin.pluginName] = analyticsConfig
self.playerController = PlayKitManager.sharedInstance.loadPlayer(config: playerConfig.plugins)
```
### Kaltura Stats Plugin Supported Events  

The Kaltura Stats Plugin supports the following events:

```swift
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

## TVPAPI Stats Plugin

This section describes the steps required for using the TVPAPI Stats Plugin on iOS devices to get statistical information on the device, as well as the events supported by the plugin.

### Enabling the TVPAPI Stats Plugin for the Kaltura Video Player  

To enable the TVPAPI Stats Plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/PhoenixPlugin'
```

### Register the TVPAPI Stats Plugin  

Register the TVPAPI Stats Plugin in your application as follows:

```swift
PlayKitManager.sharedInstance.registerPlugin(TVPAPIAnalyticsPlugin.self)
```

### Configure the Kaltura Video Player to use the TVPAPI Stats Plugin  

To configure the player to use TVPAPI Stats Plugin, add the following configuration to your `PlayerConfig` file as follows:

```swift
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

```swift
var playerController: Player!
let config = PlayerConfig()
var pluginsConfig = [String : AnyObject?]()
playerConfig.plugins[TVPAPIAnalyticsPlugin.pluginName] = analyticsConfig
self.playerController = PlayKitManager.sharedInstance.loadPlayer(config: playerConfig.plugins)

```

## TVPAPI Stats Plugin Supported Events  

The TVPAPI Stats Plugin supports the following events:

```swift
 TVPAPI action Types{
 MediaHit, //outputs every interval time
 MediaMark //Outputs in the following events - {PLAY,STOP,PAUSE,FIRST_PLAY,LOAD,FINISH,BITRATE_CHANGE,ERROR}
}
```

## Concurrency Handler  

To receive concurrency events from the TVPAPI Stats Plugin, you'll need to add a listener to the following event:

```swift
var playerController: Player!
self.playerController.addObserver(self, events: [OttEvent.OttEventConcurrency.self], block: {(info) in

})                    
```

## Phoenix Stats Plugin  

This section describes the steps required for configuring the Kaltura Video Player to use the Phoenix Stats Plugin on iOS devices as well as the supported plugin events. This will enable you to obtain important statistical information about usage.

<details><summary>**Click for Integration**</summary><p>
TBD
</p></details>

## Youbora Plugin  

This section describes the steps required for implementing the Youbora Plugin on iOS devices. Youbora is an intelligence analytics and optimization platform used in Kaltura's solution to track media analytics events. 

You'll need to set up an account in http://www.youbora.com and then set the account details in the plugin configuration to use this plugin. After these steps, you'll be able to use the Youbora dashboard and watch statistical events and analytics sent by the Kaltura Video Payer.

### Enabling the Youbora Plugin for the Kaltura Video Player  

To enable the Youbora Stats Plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/YouboraPlugin'
```

### Register Plugin

```swift
PlayKitManager.sharedInstance.registerPlugin(YouboraPlugin.self)
```

### Create a Config and set below custom params

```
config["accountCode"] = *{account_code}*
config["username"] = *{user_name}*
```

>Note: Only then load player with Plugin Config.


## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
