---
layout: page
---

#Error Handling

The SDK provides error handling using observation.

Errors from the observation comes as `NSError` object that includes: domain, error code, description and userInfo with extra information about the error like root error for example.

##Error Domains and Codes

All error domains are centerlized at `PKErrorDomain` for easy access, for example: `PKErrorDomain.Player` get the player error domain. 

###Player - (`PlayerError`)

Player errors contain 4 types:

1. `failedToLoadAssetFromKeys`, code: 7000.</br>userInfo holds the root error if exists. Sent when asset was trying to load and one of the required keys (playable for example) couldn't load.
2. `assetNotPlayable`, code: 7001.</br>Sent when the asset already loaded his required keys but isn't playable.
3. `failedToPlayToEndTime`, code: 7002.</br>userInfo holds the root error if exists. Sent when player failed to play to the end time.
4. `playerItemErrorLogEvent`, code: 7003.</br>wraps `AVPlayerItemErrorLogEvent` which contains all error log events.</br>userInfo holds the root error code and root domain of the original error. Sent when player received error log event.

###Plugins General (`PKPluginError`)

For plugins we have 2 general errors:

1. `failedToCreatePlugin`, code: 2000.</br>Sent when failed to create the plugin.
2. `missingPluginConfig`, code: 2001.</br>userInfo holds the plugin name. Sent when the plugin is missing his config.

###Analytics Plugins - (`AnalyticsError`)

1. `missingMediaEntry`, code: 2100.</br>Sent when failed to send analytics event because media entry is missing.
2. `missingInitObject`, code: 2101.</br>userInfo holds the plugin name. Sent when failed to send analytics event because initObj is missing.

###Youbora - (`YouboraPluginError`)

Youbora has only one error, `failedToSetupYouboraManager`, code: 2200.</br>Sent when failed to setup Youbora manager, can happen when config is wrong or media entry is missing.

###IMA - (`IMAPluginError`)

IMA errors codes (see `IMAErrorCode` for all codes) and descriptions are the same as the original error. 
In addition, the userInfo holds the the error type from IMA error types.

###DRM

####Widevine Classic (`WidevineClassError`)

Widevine classic has 2 errors:

1. `invalidDRMData`, code: 6200.</br>Sent when we could not extract the license URI from the DRM data.
2. `missingWidevineFile`, code: 6201.</br>Sent when registering local asset fails because widevine file not found.

##Usage

Loading a `Player` object can fail and we want to make sure you have the ability to handle such cases:

>swift

```swift
do {
    player = try PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
} catch let e {
    // handle error
    if e.code == PKErrorCode.failedToCreatePlugin {
        // handle failed to create plugin
    } else if e.code == PKErrorCode.missingPluginConfig {
        // handle missing plugin config
    }
}
```

>objc

```objc
NSError *error = nil;
self.kPlayer = [PlayKitManager.sharedInstance loadPlayerWithPluginConfig: pluginConfig error: &error];

if (error) {
    // handle error
    if (error.code == PKErrorCode.FailedToCreatePlugin) {
        // handle failed to create plugin
    } else if (error.code == PKErrorCode.MissingPluginConfig) {
        // handle missing plugin config
    }
}
```

In order to observe errors we use the following types:

1. `PlayerEvent.error` - represent player related errors.
2. `PlayerEvent.pluginError` - represent plugin related errors.
3. `AdEvent.error` - represents ads error

For example observing `PlayerEvent.error`:

>swift

```swift
player.addObserver(self, events: [PlayerEvent.error]) { event in
    if let error = event.error, error.code == PKErrorCode.assetNotPlayable {
        // handle error
    }
}
```

>objc

```objc
[self.kPlayer addObserver:self events:@[PlayerEvent.error] block:^(PKEvent * _Nonnull event) {
    NSError *error = event.error;
    if (error && error.code == PKErrorCode.AssetNotPlayable) {
        // handle error
    }
}];
```
