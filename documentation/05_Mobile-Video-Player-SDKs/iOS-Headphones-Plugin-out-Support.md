---
layout: page
title: iOS Headphones Plug/ Unplug Support
subcat: iOS
weight: 230
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes how to get fired when headphones are plugged/ unplugged.

This should be implemented on the application side.

```objective_c 
NSNotificationCenter *nc [NSNotificationCenter defaultCenter];
[nc addObserver:self
       selector:@selector(routeChanged:)
           name:AVAudioSessionRouteChangeNotification
         object:nil];         
```

This code was taken from:
[Responding to Audio Hardware Route Changes](https://developer.apple.com/library/ios/documentation/Audio/Conceptual/AudioSessionProgrammingGuide/HandlingAudioHardwareRouteChanges/HandlingAudioHardwareRouteChanges.html)

Use the [KPController](https://github.com/kaltura/player-sdk-native-ios/blob/master/KALTURAPlayerSDK/KPController.h) instance under 'KPViewController' to control your playback.

