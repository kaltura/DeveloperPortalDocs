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
| Kaltura Stats         | [Kaltura Stats](v3_iOS_Analytics.html#KalturaStatsPlugin)       |
| Kaltura Live Stats    | [Kaltura Live Stats](v3_iOS_Analytics.html#KalturaLiveStatsPlugin)              |
| TVPAPI                | [TVPAPI](v3_iOS_Analytics.html#TVPAPI)               |
| Phoenix               | [Phoenix](v3_iOS_Analytics.html#Phoenix)               |

>**Important**: Best practice for using analytics is to register plugins in the `AppDelegate` file.

## Youbora Plugin  

This section describes the steps required for implementing the Youbora Plugin on iOS devices. Youbora is an intelligence analytics and optimization platform used in Kaltura's solution to track media analytics events. 

You'll need to set up an account in http://www.youbora.com and then set the account details in the plugin configuration to use this plugin. After these steps, you'll be able to use the Youbora dashboard and watch statistical events and analytics sent by the Kaltura Video Payer.

For additional information on the YouboraPlugin options dictionary refer to their [developer portal](http://developer.nicepeopleatwork.com/plugins/general/setting-youbora-options/).

### Getting Started with the Youbora Plugin  

To enable the Youbora Stats Plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/YouboraPlugin'
```

#### Register Plugin

>swift

```swift
PlayKitManager.shared.registerPlugin(YouboraPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin: YouboraPlugin.self];
```

#### Create a Config and Load Player

>swift

```swift
// config options
let youboraOptions: [String: Any] = [
    "accountCode": "nicetest" // mandatory
    // YouboraPlugin.enableSmartAdsKey: true - use this if you want to enable smart ads
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
                           @"accountCode": @"nicetest" // mandatory
                           // [YouboraPlugin enableSmartAdsKey]: @true - use this if you want to enable smart ads
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

>Note: Only now load the player with the Plugin Config.


## Kaltura Stats Plugin

This section describes the steps required for using the Kaltura stats plugin. 

### Getting Started  with the Kaltura Stats Plugin

#### Register the Plugin

>swift

```swift
PlayKitManager.shared.registerPlugin(KalturaStatsPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin:KalturaStatsPlugin.self];
```

#### Create a Config and Load Player

>swift

```swift
// config params, defaults values, insert your data instead
let KalturaStatsPluginConfig = KalturaStatsPluginConfig(uiconfId: 0,
                                                        partnerId: 0,
                                                        entryId: "")
// create config dictionary
let config = [KalturaStatsPlugin.pluginName: KalturaStatsPluginConfig]
// create plugin config object
let pluginConfig = PluginConfig(config: config)
// load the player with the created plugin config
let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
// config params, defaults values, insert your data instead                     
KalturaStatsPluginConfig *kalturaStatsConfig = [[KalturaStatsPluginConfig alloc] initWithUiconfId:0
                                                                                        partnerId:0
                                                                                          entryId:@""];
// create config dictionary
NSMutableDictionary *config = [NSMutableDictionary dictionary];
// set the created config to the plugin name key in the dictionary
config[KalturaStatsPlugin.pluginName] = KalturaStatsPluginConfig;
// create plugin config object
PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
// load the player with the created plugin config
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

### Kaltura Stats Plugin Events

This section describes the events available for the Kaltura Stats plugin.

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

## Kaltura Live Stats Plugin  

This section describes the steps required for using the Kaltura live stats plugin. 

### Get Started  with the Kaltura Live Stats Plugin  

#### Register the Plugin

>swift

```swift
PlayKitManager.shared.registerPlugin(KalturaLiveStatsPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin:KalturaLiveStatsPlugin.self];
```

#### Create a Config and Load Player

>swift

```swift
// config params, defaults values, insert your data instead
let kalturaLiveStatsPluginConfig = KalturaLiveStatsPluginConfig(entryId: "",
                                                              partnerId: 0)
// create config dictionary
let config = [KalturaLiveStatsPlugin.pluginName: kalturaLiveStatsPluginConfig]
// create plugin config object
let pluginConfig = PluginConfig(config: config)
// load the player with the created plugin config
let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
// config params, defaults values, insert your data instead                     
KalturaLiveStatsPluginConfig *kalturaLiveStatsPluginConfig = [[KalturaLiveStatsPluginConfig alloc] initWithUiconfId:0
                                                                                                          partnerId:0
                                                                                                            entryId:@""];
// create config dictionary
NSMutableDictionary *config = [NSMutableDictionary dictionary];
// set the created config to the plugin name key in the dictionary
config[KalturaLiveStatsPlugin.pluginName] = kalturaLiveStatsPluginConfig;
// create plugin config object
PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
// load the player with the created plugin config
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

## TVPAPI Analytics Plugin  

This section describes the steps required for using the TVPAPI analytics plugin on iOS devices to get statistical information on the device, as well as the events supported by the plugin.

### Getting Started with the TVPAPI Plugin  

#### Enabling the TVPAPI Analytics Plugin for the Kaltura Video Player  

To enable the TVPAPI analytics plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/PhoenixPlugin'
```

#### Register the TVPAPI Analytics Plugin  

Register the TVPAPI analytics plugin in your application as follows:

>swift

```swift
PlayKitManager.shared.registerPlugin(TVPAPIAnalyticsPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin:TVPAPIAnalyticsPlugin.self];
```

#### Create a Config and Load Player

>swift

```swift
// config params, defaults values, insert your data instead
let initObject: [String: Any] =  [
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
         
let tvpapiPluginConfig = TVPAPIAnalyticsPluginConfig(baseUrl: "",
                                               timerInterval: 30,
                                                  initObject: initObject)
// create config dictionary
let config = [TVPAPIAnalyticsPlugin.pluginName: tvpapiPluginConfig]
// create plugin config object
let pluginConfig = PluginConfig(config: config)
// load the player with the created plugin config
let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
NSDictionary *initObject = @{
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
                             }];

// config params, defaults values, insert your data instead                                              
TVPAPIAnalyticsPluginConfig *tvpapiPluginConfig = [[TVPAPIAnalyticsPluginConfig alloc] initWithBaseUrl:@""
                                                                                         timerInterval:30.0f
                                                                                            initObject:initObject];
// create config dictionary
NSMutableDictionary *config = [NSMutableDictionary dictionary];
// set the created config to the plugin name key in the dictionary
config[TVPAPIAnalyticsPlugin.pluginName] = tvpapiPluginConfig;
// create plugin config object
PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
// load the player with the created plugin config
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

## Phoenix Analytics Plugin  

This section describes the steps required for configuring the Kaltura Video Player to use the Phoenix Stats Plugin on iOS devices as well as the supported plugin events. This will enable you to obtain important statistical information about usage.

### Getting Started with the Phoenix Plugin  

To enable the Phoenix Analytics plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/PhoenixPlugin'
```

##### Register the Phoenix Analytics Plugin  

Register the Phoenix Analytics plugin in your application as follows:

>swift

```swift
PlayKitManager.shared.registerPlugin(PhoenixAnalyticsPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin:PhoenixAnalyticsPlugin.self];
```

#### Create a Config and Load Player  

>swift

```swift
// set config. this are defaults values, insert your data instead
let config = [
    PhoenixAnalyticsPlugin.pluginName: PhoenixAnalyticsPluginConfig(baseUrl: "",
                                                              timerInterval: 30,
                                                                         ks: "",
                                                                  partnerId: 0)
]
// create plugin config object
let pluginConfig = PluginConfig(config: config)
// load the player with the created plugin config
let player = PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
```

>objc

```objc
// create config dictionary
NSMutableDictionary *config = [NSMutableDictionary dictionary];
// set config. this are defaults values, insert your data instead
config[PhoenixAnalyticsPlugin.pluginName] = [[PhoenixAnalyticsPluginConfig alloc] initWithBaseUrl:@""
                                                                                    timerInterval:30.0f
                                                                                               ks:@""
                                                                                        partnerId:0];
// create plugin config object
PluginConfig *pluginConfig = [[PluginConfig alloc] initWithConfig:config];
// load the player with the created plugin config
self.player = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig:pluginConfig];
```

## OTT Stats Plugin Info  

This section provides additional information on the OTT Stats plugin.

### OTT Stats Plugin Supported Events  

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

### Concurrency Handler  

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
