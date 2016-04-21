---
layout: page
title: Using the Kaltura SDK with Swift
---

# Using the Kaltura SDK with Swift
To learn more about Swift, refer to the article:
{% extlink Swift and Objective-C in the Same Project https://developer.apple.com/library/ios/documentation/Swift/Conceptual/BuildingCocoaApps/MixandMatch.html#//apple_ref/doc/uid/TP40014216-CH10-ID122 %}

To use the Kaltura SDK with Swift:

In the Swift bridge file add `KalturaDemoSwift-Bridging-Header.h`:

```
#import <KALTURAPlayerSDK/KPViewController.h>
#import <KALTURAPlayerSDK/KPLocalAssetsManager.h>
```
