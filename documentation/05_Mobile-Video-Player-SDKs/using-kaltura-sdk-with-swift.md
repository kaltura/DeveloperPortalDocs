---
layout: page
title: Using the Kaltura SDK with Swift
subcat: iOS
weight: 290
---

Swift is a programming language developed by Apple Inc. to work with existing Objective-C code that was written for Apple products.

To use the Player-SDK with Swift you will need to do the following:

In the Swift bridge file add `KalturaDemoSwift-Bridging-Header.h`:

```
#import <KALTURAPlayerSDK/KPViewController.h>
#import <KALTURAPlayerSDK/KPLocalAssetsManager.h>
```

To learn more about Swift, see [Using Swift and Objective-C in the Same Project](https://developer.apple.com/library/ios/documentation/Swift/Conceptual/BuildingCocoaApps/MixandMatch.html#//apple_ref/doc/uid/TP40014216-CH10-ID122).
