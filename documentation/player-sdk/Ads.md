---
layout: page
title: Using Google Ads in iOS
---

#Linking Google Ads

###With Cocoapods:

Add these 2 pods to your podfile:

```
pod 'Google-Mobile-Ads-SDK'
pod 'GoogleAds-IMA-iOS-SDK-For-AdMob', '~> 3.0.beta.16'

```

###Traditional way:

###Linking to GoogleInteractiveMediaAds SDK
 1. If you use ads you will have to download **`GoogleMobileAds`** from: [Admob](https://developers.google.com/admob/ios/download) and add it to your project
 2. In addition to the **`GoogleMobileAds`** you should download **`GoogleInteractiveMediaAds`** from: [IMA SDK](https://developers.google.com/interactive-media-ads/docs/sdks/ios/download), if you are going to use **Admob** in addition to the **`IMA SDK`** you should add **GoogleInteractiveMediaAds-GoogleIMA3ForAdMob** to your project and if you are going to use only **`IMA SDK`** you should add **GoogleInteractiveMediaAds-GoogleIMA3** to your project.
 3. Required frameworks for **`GoogleMobileAds`**:
	- StoreKit.framework
	- EventKit.framework
	- EventKitUI.framework
	- CoreTelephony.framework
	- MessageUI.framework



#Listening to Ad's events

If you should listen to ad's events you can use:

todo link to the kdp api example

[List of commonly used player ad events](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/media-player/Kaltura-Media-Player-API.md#commonly-used-player-ad-events-ad-sequence-events)

```
[self.player addKPlayerEventListener:@"adClick"
                             eventID:@"some_id"
                             handler:^(NSString *eventName, NSString *params) {
            						// Do your stuff here..
        }];
```

[IMAWebOpenerDelegate](https://developers.google.com/interactive-media-ads/docs/sdks/ios/v3/api/protocol_i_m_a_web_opener_delegate-p#instance-methods)

