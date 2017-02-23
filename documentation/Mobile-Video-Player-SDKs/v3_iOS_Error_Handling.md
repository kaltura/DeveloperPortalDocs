---
layout: page
---

#Error Handling

The SDK provides error handling using observation.

Errors from the observation comes as `NSError` object that includes: domain, error code, description and userInfo with extra information about the error like root error for example.

##Error Domains and Codes

###Player - (PlayerError)

Player errors contain 4 types:

1. `failedToLoadAssetFromKeys`, code: 7000, userInfo holds the root error if exists. Sent when asset was trying to load and one of the required keys (playable for example) couldn't load.
2. `assetNotPlayable`, code: 7001. Sent when the asset already loaded his required keys but isn't playable.
3. `failedToPlayToEndTime`, code: 7002, userInfo holds the root error if exists. Sent when player failed to play to the end time.
4. `playerItemErrorLogEvent`, this error wrap `AVPlayerItemErrorLogEvent` which contains all error log events type. code: 7003, userInfo holds the root error code and root domain of the original error. Sent when player received error log event.

###Plugins General (PKPluginError)

For plugins we have 2 general errors:

1. `failedToCreatePlugin`, code: 2000. Sent when failed to create the plugin.
2. `missingPluginConfig`, code: 2001, userInfo holds the plugin name. Sent when the plugin is missing his config.

###IMA - (IMAPluginError)

IMA errors codes and descriptions are the same as the original error. 
In addition, the userInfo holds the the error type from IMA error types.

###Analytics Plugins - (AnalyticsError)

1. `missingMediaEntry`, code: 3000. Sent when failed to send analytics event because media entry is missing.
2. `missingInitObject`, code: 3001, userInfo holds the plugin name. Sent when failed to send analytics event because initObj is missing.

###Youbora - (YouboraPluginError)

Youbora has only one error, `failedToSetupYouboraManager`, code: 4000. Sent when failed to setup Youbora manager, can happen when config is wrong or media entry is missing.
