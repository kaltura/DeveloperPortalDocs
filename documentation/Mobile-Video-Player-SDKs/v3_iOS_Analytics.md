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
| Youbora               | [Youbora Developer Portal](http://developer.nicepeopleatwork.com) |
| Kaltura Stats         | []()             |
| Kaltura Live Stats    | []()             |
| TVPAPI                | []()             |
| Phoenix               | []()             |

> **important - best practice is to register plugins in `AppDelegate` file.**

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

### Create a config and load player

>swift

```swift
// config options
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
// create analytics config with the created params
let youboraConfig = AnalyticsConfig(params: youboraOptions)
// create config dictionary
let config = [YouboraPlugin.pluginName: youboraConfig]
// create plugin config object
let pluginConfig = PluginConfig(config: config)
// load the player with the created plugin config
let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
// config options
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
// create analytics config with the created params                        
AnalyticsConfig *youboraConfig = [[AnalyticsConfig alloc] initWithParams: youboraOptions];
// create config dictionary
NSMutableDictionary *config = [NSMutableDictionary dictionary];
// set the created config to the plugin name key in the dictionary
config[PhoenixAnalyticsPlugin.pluginName] = youboraConfig;
// create plugin config object
PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
// load the player with the created plugin config
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

>Note: Only then load player with Plugin Config.

</p></details> 

## Kaltura Stats Plugin + Kaltura Live Stats Plugin Configuration 

This section describes the steps required for using the Kaltura stats plugin or live stats plugin. 

<details><summary>Get Started With Kaltura Stats + Live Stats</summary><p>

`KalturaStatsPlugin` will be used in the code sample but the same configuration applies for `KalturaLiveStatsPlugin` just replace the class.

### Register the plugin

>swift

```swift
PlayKitManager.shared.registerPlugin(KalturaStatsPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin:KalturaStatsPlugin.self];
```

### Create a config and load player

>swift

```swift
// config params, defaults values, insert your data instead
let kalturaStatsPluginParams: [String: Any] = [
   "sessionId": "",
   "uiconfId": 0,
   "baseUrl": "",
   "partnerId": 0,
   "timerInterval": 30                                          
]
// create analytics config with the created params
let kalturaStatsConfig = AnalyticsConfig(params: kalturaStatsPluginParams)
// create config dictionary
let config = [KalturaStatsPlugin.pluginName: kalturaStatsConfig]
// create plugin config object
let pluginConfig = PluginConfig(config: config)
// load the player with the created plugin config
let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
// config params, defaults values, insert your data instead
NSDictionary *kalturaStatsPluginParams = @{
                                           @"sessionId": @"",
                                           @"uiconfId": @0,
                                           @"baseUrl": @"",
                                           @"partnerId": @0,
                                           @"timerInterval": @30
                                           };
// create analytics config with the created params                                               
AnalyticsConfig *kalturaStatsConfig = [[AnalyticsConfig alloc] initWithParams:kalturaStatsPluginParams];
// create config dictionary
NSMutableDictionary *config = [NSMutableDictionary dictionary];
// set the created config to the plugin name key in the dictionary
config[KalturaLiveStatsPlugin.pluginName] = kalturaStatsConfig;
// create plugin config object
PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
// load the player with the created plugin config
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

</p></details>

### Kaltura Stats Plugin Events

This section describes the events available for kaltura stats plugin.

<details><summary>Kaltura Stats Plugin Events</summary><p>

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

## TVPAPI Analytics Plugin

This section describes the steps required for using the TVPAPI Stats Plugin on iOS devices to get statistical information on the device, as well as the events supported by the plugin.

<details><summary>Get Started With TVPAPI Plugin</summary><p>

### Enabling the TVPAPI Stats Plugin for the Kaltura Video Player  

To enable the TVPAPI Stats Plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/PhoenixPlugin'
```

### Register the TVPAPI Stats Plugin  

Register the TVPAPI Stats Plugin in your application as follows:

>swift

```swift
PlayKitManager.shared.registerPlugin(TVPAPIAnalyticsPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin:TVPAPIAnalyticsPlugin.self];
```

### Create a config and load player

>swift

```swift
// config params, defaults values, insert your data instead
let tvpapiPluginParams: [String: Any] = [
    "fileId": "",
    "baseUrl": "",
    "timerInterval": 30,
    "initObj": [
        "Token": "",
        "SiteGuid": "",
        "ApiUser": "",
        "DomainID": "",
        "UDID": "",
        "ApiPass": "",
        "Locale": [
            "LocaleUserState": "",
            "LocaleCountry": "",
            "LocaleDevice": "",
            "LocaleLanguage": ""
        ],
        "Platform": ""
    ]
]
// create analytics config with the created params
let tvpapiPluginConfig = AnalyticsConfig(params: tvpapiPluginParams)
// create config dictionary
let config = [TVPAPIAnalyticsPlugin.pluginName: tvpapiPluginConfig]
// create plugin config object
let pluginConfig = PluginConfig(config: config)
// load the player with the created plugin config
let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
// config params, defaults values, insert your data instead
NSDictionary *tvpapiPluginParams = @{
                                     @"fileId": @"",
                                     @"baseUrl": @"",
                                     @"timerInterval": @30,
                                     @"initObj": @{
                                                  @"Token": @"",
                                                  @"SiteGuid": @"",
                                                  @"ApiUser": @"",
                                                  @"DomainID": @"",
                                                  @"UDID": @"",
                                                  @"ApiPass": @"",
                                                  @"Locale": @{
                                                              @"LocaleUserState": @"",
                                                              @"LocaleCountry": @"",
                                                              @"LocaleDevice": @"",
                                                              @"LocaleLanguage": @""
                                                              },
                                                 @"Platform": @""
                                                 }
                                     };
// create analytics config with the created params                                               
AnalyticsConfig *tvpapiPluginConfig = [[AnalyticsConfig alloc] initWithParams:tvpapiPluginParams];
// create config dictionary
NSMutableDictionary *config = [NSMutableDictionary dictionary];
// set the created config to the plugin name key in the dictionary
config[TVPAPIAnalyticsPlugin.pluginName] = tvpapiPluginConfig;
// create plugin config object
PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
// load the player with the created plugin config
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

</p></details>

## Phoenix Analytics Plugin  

This section describes the steps required for configuring the Kaltura Video Player to use the Phoenix Stats Plugin on iOS devices as well as the supported plugin events. This will enable you to obtain important statistical information about usage.

<details><summary>Get Started With Phoenix Plugin</summary><p>

To enable the phoenix analytics plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/PhoenixPlugin'
```

### Register the Phoenix Stats Plugin  

Register the phoenix analytics plugin in your application as follows:

>swift

```swift
PlayKitManager.shared.registerPlugin(PhoenixAnalyticsPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin:PhoenixAnalyticsPlugin.self];
```

### Create a config and load player

>swift

```swift
// config params, defaults values, insert your data instead
let phoenixPluginParams = [
    "fileId": "",
    "baseUrl": "",
    "ks": "",
    "partnerId": 0,
    "timerInterval": 30
]
// create analytics config with the created params
let phoenixPluginConfig = AnalyticsConfig(params: phoenixPluginParams)
// create config dictionary
let config = [PhoenixAnalyticsPlugin.pluginName: phoenixPluginConfig]
// create plugin config object
let pluginConfig = PluginConfig(config: config)
// load the player with the created plugin config
let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
// config params, defaults values, insert your data instead
NSDictionary *phoenixPluginParams = @{
                                      @"fileId": @"",
                                      @"baseUrl": @"",
                                      @"ks": @"",
                                      @"partnerId": @0,
                                      @"timerInterval": @30
                                      };
// create analytics config with the created params                                               
AnalyticsConfig *phoenixPluginConfig = [[AnalyticsConfig alloc] initWithParams:phoenixPluginParams];
// create config dictionary
NSMutableDictionary *config = [NSMutableDictionary dictionary];
// set the created config to the plugin name key in the dictionary
config[PhoenixAnalyticsPlugin.pluginName] = phoenixPluginConfig;
// create plugin config object
PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
// load the player with the created plugin config
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

</p></details>

## OTT Stats Plugin Info

<details><summary>Extra Info on OTT Stats Plugin</summary><p>

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

</p></details>

## Code Sample

[PlayKit iOS samples](https://github.com/kaltura/playkit-ios-samples) repo has a dedicated samples with more details.

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
