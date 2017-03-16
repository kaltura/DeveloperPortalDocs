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
| Youbora               | [Youbora Developer Portal](http://developer.nicepeopleatwork.com) |

>**important - best practice is to register plugins in `AppDelegate` file.

## Kaltura Live Stats Plugin  

This section describes the steps required for using the Kaltura live stats plugin on iOS devices as well as the events supported by the plugin. 

<details><summary>Get Started with Widevine Classic</summary><p>

### Register the plugin

```swift
PlayKitManager.shared.registerPlugin(KalturaLiveStatsPlugin.self)
```

```objc
[PlayKitManager.sharedInstance registerPlugin:KalturaLiveStatsPlugin.self];
```

### Create a Config and and load player



</p></details>

## Kaltura Stats Plugin  

This section describes the steps required for configuring the Kaltura Video Player to use the Kaltura Stats Plugin on iOS devices. This will enable you to obtain important statistical information about usage.

<details><summary>Get Started With Kaltura Stats Plugin</summary><p>

### Register the plugin  

To enable the Kaltura Stats Plugin, register the plugin inside your application as follows:

```swift
PlayKitManager.shared.registerPlugin(KalturaStatsPlugin.self)
```

###  the Analytics Configuration Object for the Kaltura Stats Plugin  

To configure the Kaltura Stats Plugin, add the following configuration to your `pluginConfig` file as follows:

```swift
let analyticsConfig = AnalyticsConfig()
var params: [String : Any]
params["sessionId"] = "sessionId"
params["baseUrl"] = "baseUrl" 
params["uiconfId"] = "uiconfId" 
params["partnerId"] = "partnerId" 
params["timeInterval"] = 30 // Timer interval to check progress of the media in seconds - recommended value: short media - 10, long media - 30

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

</p></details>

## TVPAPI Stats Plugin

This section describes the steps required for using the TVPAPI Stats Plugin on iOS devices to get statistical information on the device, as well as the events supported by the plugin.

<details><summary>Get Started With TVPAPI Plugin</summary><p>

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
params["timeInterval"] = 30 //Default value - 30. Value is in seconds.
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

</p></details>

## OTT Stats Plugin Supported Events  

The OTT Stats Plugins (Phoenix, TVPAPI) supports the following events:

```swift
enum OTTAnalyticsEventType: String {
    case hit
    case play
    case stop
    case pause
    case firstPlay
    case swoosh
    case load
    case finish
    case bitrateChange
    case error
}
```

## Concurrency Handler  

To receive concurrency events from the OTT Stats Plugin, you'll need to add a listener to the following event:

```swift
self.playerController.addObserver(self, events: [OttEvent.concurrency]) { event in
    // handle concurrency event
}                   
```

```objc
[self.player addObserver:self events:@[OttEvent.concurrency] block:^(PKEvent * _Nonnull event) {
    // handle concurrency event
}];
```

## Phoenix Stats Plugin  

This section describes the steps required for configuring the Kaltura Video Player to use the Phoenix Stats Plugin on iOS devices as well as the supported plugin events. This will enable you to obtain important statistical information about usage.

<details><summary>**Click for Integration**</summary><p>
TBD
</p></details>

## Youbora Plugin  

This section describes the steps required for implementing the Youbora Plugin on iOS devices. Youbora is an intelligence analytics and optimization platform used in Kaltura's solution to track media analytics events. 

You'll need to set up an account in http://www.youbora.com and then set the account details in the plugin configuration to use this plugin. After these steps, you'll be able to use the Youbora dashboard and watch statistical events and analytics sent by the Kaltura Video Payer.

For extra information on YouboraPlugin options dictionary visit [developer portal](http://developer.nicepeopleatwork.com/plugins/general/setting-youbora-options/)

<details><summary>Get Started With Youbora Plugin</summary><p>

To enable the Youbora Stats Plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/YouboraPlugin'
```

### Register Plugin

>swift

```swift
PlayKitManager.shared.registerPlugin(YouboraPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin: YouboraPlugin.self];
```

### Create a Config and and load player

>swift

```swift
let youboraOptions: [String: Any] = [
    "accountCode": "nicetest",
    "httpSecure": true,
    "parseHLS": true,
    "media": [
        "title": "Sintel",
        "duration": 600
    ],
    "properties": [
        "year": "2001",
        "genre": "Fantasy",
        "price": "free"
    ],
    "network": [
        "ip": "1.2.3.4"
    ],
    "ads": [
        "adsExpected": true,
        "campaign": "Ad campaign name"
    ],
    "extraParams": [
        "param1": "Extra param 1 value",
        "param2": "Extra param 2 value"
    ]
]

let youboraConfig = AnalyticsConfig(params: youboraOptions)
let config = [YouboraPlugin.pluginName: youboraConfig]
let pluginConfig = PluginConfig(config: config)

let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
NSDictionary * youboraOptions = @{
                           @"accountCode": @"nicetest",
                           @"httpSecure": @YES,
                           @"parseHLS": @YES,
                           @"media": @{
                                  @"title": @"Sintel",
                                  @"duration": @600
                                  },
                           @"properties": @{
                                  @"year": @"2001",
                                  @"genre": @"Fantasy",
                                  @"price": @"free"
                                  },
                           @"network": @{
                                  @"ip": @"1.2.3.4"
                                  },
                           @"ads": @{
                                  @"adsExpected": @YES,
                                  @"campaign": @"Ad campaign name"
                                  },
                           @"extraParams": @{
                                   @"param1": @"Extra param 1 value",
                                   @"param2": @"Extra param 2 value"
                                   }
                           };
                           
AnalyticsConfig *youboraConfig = [[AnalyticsConfig alloc] initWithParams: youboraOptions];
    
NSMutableDictionary *config = [NSMutableDictionary dictionary];
config[PhoenixAnalyticsPlugin.pluginName] = youboraConfig;

PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

>Note: Only then load player with Plugin Config.

</p></details>  

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
