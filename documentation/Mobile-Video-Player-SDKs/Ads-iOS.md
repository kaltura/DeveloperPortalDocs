---
layout: page
title: Using Google Ads in iOS Devices
subcat: SDK Version 2.0
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required to use Google ads in iOS devices.

## Linking Google to the iOS Device  

To enable Google Ads in iOS devices for the Kaltura Player, you will need to link Google to the iOS devices. To 
When linking Google in iOS devices for the Kaltura Player, there are a number of different options, which are described below.

## Using Cocoapods  

To link Google ads using Cocoapods, add these two pods to your podfile:

```
pod 'GoogleAds-IMA-iOS-SDK’ , '~> 3.2.1’

```
For AdMob, ignore the line above and use the following line instead:

```
pod 'GoogleAds-IMA-iOS-SDK-For-AdMob’ , '~> 3.2.1’

```

## Linking to GoogleInteractiveMediaAds SDK  

To link to Google ads using the GoogleInteractiveMediaAds SDK:
 1. Download **`GoogleMobileAds`** from: {% extlink Admob https://developers.google.com/admob/ios/download %} and add it to your project
 2. In addition to the **`GoogleMobileAds`** you will need to download **`GoogleInteractiveMediaAds`** from: {% extlink IMA SDK https://developers.google.com/interactive-media-ads/docs/sdks/ios/download %}.
	- If you are going to use **Admob** in addition to the **`IMA SDK`**, add **GoogleInteractiveMediaAds-GoogleIMA3ForAdMob** to your project.
	- If you are going to use only **`IMA SDK`**, add **GoogleInteractiveMediaAds-GoogleIMA3** to your project.
 3. The following are the required frameworks for **`GoogleMobileAds`**:
	- StoreKit.framework
	- EventKit.framework
	- EventKitUI.framework
	- CoreTelephony.framework
	- MessageUI.framework


## Configuring the Player to use Google Ads  

To configure the Player to use Google ads, add the following configuration to your `KPPlayerConfig`:

```
[config addConfigKey:@"doubleClick.plugin" withValue:@"true"];
[config addConfigKey:@"doubleClick.adTagUrl" withValue:@"your ad tag URL"];
```

## Listening to Ad Events  

To listen to ad events, use the following [Ads event test page](http://player.kaltura.com/modules/DoubleClick/tests/DoubleClickAdEvents.qunit.html).

To view list of commonly used Player ad events, click [here](https://vpaas.kaltura.com/documentation/04_Web-Video-Player/Kaltura-Media-Player-API.html).

```
[self.player addKPlayerEventListener:@"adClick"
                             eventID:@"some_id"
                             handler:^(NSString *eventName, NSString *params) {
            						// Do your stuff here..
        }];
```
For the complete IMAWebOpenerDelegate SDK, click [here](https://developers.google.com/interactive-media-ads/docs/sdks/ios/v3/api/protocol_i_m_a_web_opener_delegate-p#instance-methods)

