---
layout: page
title: Using IMA Plugin
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required to use IMA Plugin in iOS devices.

## Enabling IMA Plugin for the Kaltura Player  

To enable IMA Plugin in iOS devices for the Kaltura Player, add following line to your Podfile:

```
pod 'PlayKit/IMAPlugin'
```

## Configuring the Player to use IMA Plugin  

To configure the Player to use IMA Plugin, add the following configuration to your `PlayerConfig`:

```
let adsConfig = AdsConfig()
adsConfig.set(adTagUrl: 'your ad tag url')
playerConfig.plugins[IMAPlugin.pluginName] = adsConfig
```

## Configuring clickthrough 

The IMA Plugin offers two options for opening ad landing pages—via an in-app browser, or via Safari. By default, the plugin will open pages using Safari. To update the plugin to use an in-app browser, you’ll need to set webOpenerPresentingController value in AdsConfig object:

```
adsConfig.set(webOpenerPresentingController: webOpenerPresentingController)
```

## Adding Companion Ads

In order to see companion Ad, you should 
	1. Have an ad tag configured to return a companion ad
	2. Supply companion ad container to the plugin as following (make sure the size of the companion being returned is the same size as the UIView in which you’re trying to display it):

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

## Controlling Ads playing

In order to control ads playing during runtime implement following player delegate method:  

```
func playerShouldPlayAd(_ player: Player) -> Bool
```

## Listening to Ad Events  

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

