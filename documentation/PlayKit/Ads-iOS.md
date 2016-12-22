---
layout: page
title: Configuring the Kaltura Video Player to use IMA Plugin on iOS Devices
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required for adding support for the IMA Plugin functionality on iOS devices. IMA (or Interactive Media Ads) was developed by Google to enable you to display ads in your application's video, audio, and game content.

## Enable IMA Plugins for the Kaltura Video Player  

To enable IMA Plugins in iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```
pod 'PlayKit/IMAPlugin'
```

## Register the IMA Plugin  

Next, register the IMA Plugin inside your application as follows:

```
PlayKitManager.sharedInstance.registerPlugin(IMAPlugin.self)
```

## Configure the Kaltura Video Player to use the IMA Plugin  

To configure the player to use IMA Plugin, add the following configuration to your `PlayerConfig` file as follows:

```
let adsConfig = AdsConfig()
adsConfig.set(adTagUrl: 'your ad tag url')
playerConfig.plugins[IMAPlugin.pluginName] = adsConfig
```

## Configure Clickthroughs 

The IMA Plugin offers two options for opening ad landing pages:

* Via an in-app browser
* Via Safari 

By default, the plugin will open pages using Safari. To update the plugin to use an in-app browser, you’ll need to set the `webOpenerPresentingController value` in the AdsConfig object as follows:

```
adsConfig.set(webOpenerPresentingController: webOpenerPresentingController)
```

## Add Companion Ads

To see companion ads in the device, you'll need to implement the following steps: 

1. Configure an ad tag to return a companion ad (prepare this in advance).
2. Supply a companion ad container to the plugin using the following format (make sure the size of the companion being returned is the same size as the UIView in which you’re trying to display it):

```
adsConfig.set(companionView: companionView)
```

## Specify the Desired Bitrate and Video Formats

The IMA Plugin enables you to specify the video formats and bitrate using the following configuration:

```
adsConfig.set(videoMimeTypes: ["video/mp4", "application/x-mpegURL"])
adsConfig.set(videoBitrate: 1024)
```

## Specify the Localized Ad Language

The IMA Plugin enables you to specify the language to be used to localize ads and the Video Player UI controls. 

To do so, set the language parameter of the AdsConfig to the appropriate language code using [this reference](https://developers.google.com/interactive-media-ads/docs/sdks/ios/ads#languagecodes).

```
adsConfig.set(language: "en")
```

## Control Ad Play

To control ad play during runtime, implement the following Video Player delegate method:  

```
func playerShouldPlayAd(_ player: Player) -> Bool
```

## Listen to Ad Events  

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

