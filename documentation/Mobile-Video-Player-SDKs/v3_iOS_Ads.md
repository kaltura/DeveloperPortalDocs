---
layout: page
title: Ads
subcat: SDK 3.0 - iOS
weight: 501
---

This document describes the steps required for adding support for the IMA Plugin functionality on iOS devices. IMA (or Interactive Media Ads) was developed by Google to enable you to display ads in your application's video, audio, and game content. To learn more about Google's IMA, see [Google's IMA developer's site](https://developers.google.com/interactive-media-ads/).

> Supported IMA SDK Version is: 3.5.2

## Common Issues

There is currently an open issue with IMA SDK where removing the player view before destorying the ads manager will cause an error on the next ad playback. To fix the issue all you have to do is call the `player.destroy()` before `player.removeFromSuperview()`

If you get below error:

```
Error Domain=com.kaltura.playkit.error.ima Code=1005 "Ads cannot be requested because the ad container is not attached to the view hierarchy." UserInfo={errorType=1, NSLocalizedDescription=Ads cannot be requested because the ad container is not attached to the view hierarchy.}
```

Please make sure that the order of removing player on your side is:

> Objc

```objc
// Firstly call destroy
[_kPlayer destroy];
// Only then
[_kPlayer.view removeFromSuperview];
```

> Swift

```swift
player.destroy()
player.removeFromSuperview()
```

## Enable IMA Plugins for the Kaltura Video Player  

To enable the IMA Plugin on iOS devices for the Kaltura Video Player, add the following line to your Podfile: 

```ruby
pod 'PlayKit/IMAPlugin'
```

## Control Ad Play

To control ad play during runtime, implement the following Video Player delegate method:

>swift

```swift
func playerShouldPlayAd(_ player: Player) -> Bool {
    return true
}
```

>objc

```objc
- (BOOL)playerShouldPlayAd:(id<Player>)player {
    return YES;
}

```  

## Register the IMA Plugin  

Next, register the IMA Plugin inside your application as follows:

>swift

```swift
PlayKitManager.shared.registerPlugin(IMAPlugin.self)
```

>objc

```objc
[PlayKitManager.sharedInstance registerPlugin: IMAPlugin.self];
```

## Configure the Kaltura Video Player to Use the IMA Plugin  

To configure the player to use IMA Plugin, add the following configuration to your `PlayerConfig` file as follows:

>swift

```swift
let adsConfig = IMAConfig()
adsConfig.set(adTagUrl: 'your ad tag url')
playerConfig.plugins[IMAPlugin.pluginName] = adsConfig
```

>objc

```objc
AdsConfig *adsConfig = [IMAConfig new];
adsConfig.adTagUrl = @"https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/3274935/preroll&impl=s&gdfp_req=1&env=vp&output=xml_vast2&unviewed_position_start=1&url=[referrer_url]&description_url=[description_url]&correlator=[timestamp]";
[config setPlugins: @{IMAPlugin.pluginName: adsConfig}];
```

## Configure Clickthroughs 

The IMA Plugin offers two options for opening ad landing pages:

* Via an in-app browser
* Via Safari 

By default, the plugin will open pages using Safari. To update the plugin to use an in-app browser, you’ll need to set the `webOpenerPresentingController` value in the AdsConfig object as follows:

>swift

```swift
adsConfig.set(webOpenerPresentingController: webOpenerPresentingController)
```

>objc

```objc
adsConfig.webOpenerPresentingController = webOpenerPresentingController;
```

## Add Companion Ads

To see companion ads in the device, you'll need to implement the following steps: 

1. Configure an ad tag to return a companion ad (prepare this in advance).
2. Supply a companion ad container to the plugin using the following format (make sure the size of the companion being returned is the same size as the UIView in which you’re trying to display it):

>swift

```swift
adsConfig.set(companionView: companionView)
```

>objc

```objc
adsConfig.companionView = companionView;
```

## Specify the Desired Bitrate and Video Formats

The IMA Plugin enables you to specify the video formats and bitrate using the following configuration:

>swift

```swift
adsConfig.set(videoMimeTypes: ["video/mp4", "application/x-mpegURL"])
adsConfig.set(videoBitrate: 1024)
```

>objc

```objc
adsConfig.videoMimeTypes = @[@"video/mp4", @"application/x-mpegURL"];
adsConfig.videoBitrate = 1024;
```

## Specify the Localized Ad Language

The IMA Plugin enables you to specify the language to be used to localize ads and the Video Player UI controls. 

To do so, set the language parameter of the AdsConfig to the appropriate language code using [this reference](https://developers.google.com/interactive-media-ads/docs/sdks/ios/ads#languagecodes).

>swift

```swift
adsConfig.set(language: "en")
```

>objc

```objc
adsConfig.language = @"en";
```

## Listen to Ad Events  

Use the following code to listen to ad events:

>swift

```swift
let events: [PKEvent.Type] = [AdEvent.adDidRequestPause, AdEvent.adDidRequestResume]

player.addObserver(self, events: events) { event in
    if event is AdEvent.adDidRequestResume {
        // handle adDidRequestResume
    } else if event is AdEvent.adDidRequestPause {
        // handle adDidRequestPause
    }
})
```

>objc

```objc
NSArray *events = @[AdEvent.adDidRequestPause, AdEvent.adDidRequestResume];
        
[self.player addObserver:self events: events block:^(PKEvent * _Nonnull event) {
    if ([event isKindOfClass: AdEvent.adDidRequestResume]) {
        // handle adDidRequestResume
    } else if ([event isKindOfClass: AdEvent.adDidRequestPause]) {
        // handle adDidRequestPause
    }
}];
```

### Ad Info Event

To observe ad info when an ad is starting use the following:

>swift

```swift
player.addObserver(self, events: [AdEvent.adStarted]) { event in
    if let info = event.adInfo {
        // use ad info
        switch info.positionType {
        case .preRoll: // handle pre roll
        case .midRoll: // handle mid roll
        case .postRoll: // handle post roll
        }
    }
})
```

>objc

```objc
[self.kPlayer addObserver: self events: @[AdEvent.adStarted] block:^(PKEvent * _Nonnull event) {
    PKAdInfo *info = event.adInfo;
    if (info) {
        // use ad info
        switch (info.positionType) {
            case AdPositionTypePreRoll:
                // handle pre roll
                break;
            case AdPositionTypeMidRoll:
                // handle mid roll
                break;
            case AdPositionTypePostRoll:
                // handle post roll
                break;
        }
    }
}];
```

### Ad Cue Points Event

To observe ad cue points update use the following:

>swift

```swift
player.addObserver(self, events: [AdEvent.adCuePointsUpdate]) { event in
    if let adCuePoints = event.adCuePoints {
        // use ad cue points
        if adCuePoints.hasPreRoll || adCuePoints.hasMidRoll || adCuePoints.hasPostRoll {
            // do your stuff
    }
})
```

>objc

```objc
[self.kPlayer addObserver: self events: @[AdEvent.adCuePointsUpdate] block:^(PKEvent * _Nonnull event) {
    PKAdCuePoints *adCuePoints = event.adCuePoints;
    if (adCuePoints) {
        // use ad cue points
        if (adCuePoints.hasPreRoll || adCuePoints.hasMidRoll || adCuePoints.hasPostRoll) {
            // do your stuff
        }
    }
}];
```

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
