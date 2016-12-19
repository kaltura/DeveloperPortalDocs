---
layout: page
title: Using IMA Plugin
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required for using IMA Plugins in iOS devices.

## Enabling IMA Plugins for the Kaltura Player  

1. To enable IMA Plugins in iOS devices for the Kaltura Player, add the following line to your Podfile: ```pod 'PlayKit/IMAPlugin'```

2. Next, register the IMA Plugin inside your application:
```
PlayKitManager.sharedInstance.registerPlugin(IMAPlugin.self)
```

## Configuring the Player to use IMA Plugins  

To configure the Player to use IMA Plugins, add the following configuration to your `PlayerConfig`:

```
let adsConfig = AdsConfig()
adsConfig.set(adTagUrl: 'your ad tag url')
playerConfig.plugins[IMAPlugin.pluginName] = adsConfig
```

## Configuring Clickthroughs 

The IMA Plugin offers two options for opening ad landing pages — via an in-app browser, or via Safari. By default, the plugin will open pages using Safari. To update the plugin to use an in-app browser, you’ll need to set the `webOpenerPresentingController value` in the AdsConfig object:

```
adsConfig.set(webOpenerPresentingController: webOpenerPresentingController)
```

## Adding Companion Ads

To see companion ads, you'll need to: 

1. Have an ad tag configured to return a companion ad.
2. Supply a companion ad container to the plugin using the following format (make sure the size of the companion being returned is the same size as the UIView in which you’re trying to display it):

```
adsConfig.set(companionView: companionView)
```

## Specifying desired bitrate and video formats

The IMA Plugin allows you to specify the video formats and bitrate, configure it as following:

```
adsConfig.set(videoMimeTypes: ["video/mp4", "application/x-mpegURL"])
adsConfig.set(videoBitrate: 1024)
```

## Specifying language

The IMA Plugin allows you to specify the language to be used to localize ads and the player UI controls. To do so, set the language parameter of AdsConfig to the appropriate language code (https://developers.google.com/interactive-media-ads/docs/sdks/ios/ads#languagecodes)

```
adsConfig.set(language: "en")
```

## Controlling Ad Play

To control ad play during runtime, implement the following player delegate method:  

```
func playerShouldPlayAd(_ player: Player) -> Bool
```

## Listening to Ad Events  

Use the following code to listen to ad events:

```
let events: [PKEvent.Type] = [AdEvents.adDidRequestPause.self, AdEvents.adDidRequestResume.self, AdEvents.adResumed.self, AdEvents.adTapped.self]

player.addObserver(self, events: events, block: { (event: Any) -> Void in
            if event is AdEvents.adDidRequestResume {
  
            } else if event is AdEvents.adDidRequestPause {
 
            } else if event is AdEvents.adTapped {

            } else if event is AdEvents.adResumed {
  
            }
        })
```

